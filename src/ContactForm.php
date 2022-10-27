<?php

namespace Websovn;

use Illuminate\Http\RedirectResponse;
use Webso\Request;
use Webso\Session;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;

class ContactForm
{
    /**
     * Số lần hiển thì lặp lại
     *
     * @var integer
     */
    protected static $showRepeat = 1;

    /**
     * Tên Session
     *
     * @var string
     */
    protected static $sessionName = 'contactformName';

    /**
     * Method FORM
     *
     * @var string
     */
    protected static $method = 'POST';

    /**
     * Action FORM
     *
     * @var string
     */
    protected static $action = '#';

    /**
     * Tên bảng
     *
     * @var string
     */
    protected static $table = 'tbl_dangky';

    /**
     * Tiêu đề gửi email
     *
     * @var string
     */
    protected static $subject;

    /**
     * Nội dung gửi email
     *
     * @var string
     */
    protected static $message;

    /**
     * Từ khóa thay thế nội dung khách hàng
     *
     * @var string
     */
    protected static $keyReplace = '[THONGTINDANGKY]';

    /**
     * Hiển thị form
     *
     * @var boolean
     */
    protected static $formShow = true;

    /**
     * Cho phép gửi email
     *
     * @var boolean
     */
    protected $isSendMail = true;

    /**
     * Mô tả về form
     *
     * @var string
     */
    protected $description;

    /**
     * Hiển thị nút gọi form
     *
     * @var boolean
     */
    protected $withButton = false;

    protected $buttonClassWrap;
    protected $buttonClass;
    protected $buttonIcon;
    protected $buttonLabel;
    protected $buttonZindex;

    /**
     * New Class
     *
     * @return static
     */
    public static function make()
    {
        return new static();
    }

    /**
     * Mô tả form
     *
     * @param string $description
     * @return $this
     */
    public function description(string $description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Bật/Tắt gửi email
     *
     * @param boolean $isSend
     * @return $this
     */
    public function isSendMail(bool $isSend = true)
    {
        $this->isSendMail = (bool) $isSend;

        return $this;
    }

    /**
     * Tùy chỉnh từ khóa dùng để thay thế
     *
     * @param string $keyReplace
     * @return $this - Default: [THONGTINDANGKY]
     */
    public function keyReplace(string $keyReplace)
    {
        static::$keyReplace = $keyReplace;

        return $this;
    }

    /**
     * Gán tiêu đề gửi email
     *
     * @param string $subject
     * @return $this
     */
    public function subject(string $subject)
    {
        static::$subject = $subject;

        return $this;
    }

    /**
     * Alias subject()
     *
     * @param string $subject
     * @return $this
     */
    public function title(string $subject)
    {
        return $this->subject($subject);
    }

    /**
     * Gán nội dung gửi email
     *
     * @param string $message - keyword: [THONGTINDANGKY]
     * @return $this
     */
    public function message(string $message)
    {
        static::$message = $message;

        return $this;
    }

    /**
     * Set Method FORM
     *
     * @param string $method
     * @return $this
     */
    public function method(string $method)
    {
        if (in_array(strtoupper($method), ['GET', 'POST'])) {
            static::$method = $method;
        }

        return $this;
    }

    /**
     * Set Action form
     *
     * @param string $action
     * @return string
     */
    public function action(string $action)
    {
        static::$action = $action;

        return $this;
    }

    /**
     * Gán tên bảng
     *
     * @param string $table
     * @return $this
     */
    public function table(string $table)
    {
        static::$table = $table;

        return $this;
    }

    /**
     * Gán số lần hiển thị lại sau khi tải trang
     *
     * @param int $showRepeat
     * @return $this
     */
    public function setNumberShow(int $showRepeat)
    {
        if (is_int($showRepeat)) {
            static::$showRepeat = $showRepeat;
        }

        return $this;
    }

    /**
     * Nạp file View
     *
     * @param string $view
     * @return string
     */
    protected static function view(string $view)
    {
        if (blank($view)) {
            return;
        }

        if (! Str::endsWith($view, '.tpl')) {
            $view = sprintf('%s.tpl', $view);
        }

        $file = __DIR__.'/views/'.$view;

        if (! is_file($file)) {
            return;
        }

        return $file;
    }

    /**
     * Lấy số lần đã hiện thị form
     *
     * @return int|boolean
     */
    protected static function getNumberShow()
    {
        return Session::get(static::$sessionName) ?? 0;
    }

    /**
     * Gán số lần hiện thị form
     *
     * @param integer $num
     * @return $this
     */
    protected static function addTimesShow(int $num = 1)
    {
        if (is_int($num) && ! is_bool(Session::get(static::$sessionName))) {
            Session::set(
                static::$sessionName,
                (static::getNumberShow() + $num)
            );
        }
    }

    /**
     * Form được hiện thì nếu TRUE
     *
     * @return boolean
     */
    protected static function isShowForm()
    {
        if (static::getNumberShow() === false) {
            return false;
        }

        return static::getNumberShow() < (static::$showRepeat + 1);
    }

    /**
     * Render View
     *
     * @return void
     */
    public function render()
    {
        static::addTimesShow();

        return render_template(
            static::view('form'),
            [
                'method'          => static::$method,
                'action'          => static::$action,
                'description'     => $this->description,
                'withButton'      => $this->withButton,
                'isShow'          => static::isShowForm(),
                'buttonClassWrap' => $this->buttonClassWrap,
                'buttonClass'     => $this->buttonClass,
                'buttonIcon'      => $this->buttonIcon,
                'buttonLabel'     => $this->buttonLabel,
                'buttonZindex'    => $this->buttonZindex,
            ]
        );
    }

    /**
     * Gán z-index cho nút gọi form
     *
     * @param integer $zindex
     * @return $this
     */
    public function buttonZindex(int $zindex)
    {
        $this->buttonZindex = $zindex;

        return $this;
    }

    /**
     * Gán label cho nút gọi form
     *
     * @param string $label
     * @return $this
     */
    public function buttonLabel(string $label)
    {
        $this->buttonLabel = $label;

        return $this;
    }

    /**
     * Gán icon cho nút gọi form
     *
     * @param string $icon
     * @return $this
     */
    public function buttonIcon(string $icon)
    {
        $this->buttonIcon = $icon;

        return $this;
    }

    /**
     * Gán class cho div bao cho nút gọi form
     *
     * @param string $class
     * @return $this
     */
    public function buttonClassWrap(string $class)
    {
        $this->buttonClassWrap = $class;

        return $this;
    }

    /**
     * Gán class cho nút gọi form
     *
     * @param string $class
     * @return $this
     */
    public function buttonClass(string $class)
    {
        $this->buttonClass = $class;

        return $this;
    }

    /**
     * Xử lý form
     *
     * @param Request $request
     * @return void
     */
    public function query(Request $request)
    {
        $isMethod = Str::upper(static::$method);

        if ($isMethod == 'POST') {
            $posts = $request->request->all();
        } else {
            $posts = $request->query->all();
        }

        if ($request->getMethod() != $isMethod) {
            (new RedirectResponse(url()))->send();
            dd();
        }

        $posts = clean_request($posts);

        if (! has_table(static::$table)) {
            throw new \RuntimeException(
                "Không tìm thấy bảng [ %s ]",
                static::$table
            );
        }

        $insert_res = truyvan(static::$table)->insert([
            'noidung' => json_encode($posts),
            'ngaygui' => Carbon::now()->format('U')
        ]);

        // After Insert
        if ($insert_res) {
            //
            $this->forceHide();

            tao_thongdiep(arraybien('Gửi thành công'));

            if (blank(static::$subject)) {
                static::$subject = arraybien(sprintf(
                    'Bạn có đăng ký mới tại Website %s',
                    cnf_get('domain')
                ));
            }

            if (blank(static::$message)) {
                static::$message = arraybien(sprintf(
                    'Thông tin đăng ký mới: %s',
                    static::$keyReplace
                ));
            }

            // Replace
            $tableHtml = render_template(static::view('info'), ['data' => $posts]);
            $message = Str::replace(
                static::$keyReplace,
                $tableHtml,
                static::$message
            );

            $subject = static::$subject;
            $message = $message;

            if ($this->isSendMail) {
                sendmail([
                    "emailnhan" => cnf_get('email_nhan'),
                    "emailgui"  => cnf_get('hostmail_user'),
                    "hostmail"  => cnf_get('hostmail'),
                    "user"      => cnf_get('hostmail_user'),
                    "pass"      => cnf_get('hostmail_pass'),
                    "tieude"    => $subject,
                    "fullname"  => cnf_get('hostmail_fullname'),
                    "port"      => cnf_get('hostmail_port'),
                    "ssl"       => cnf_get('hostmail_ssl'),
                    "subject"   => $subject,
                    "message"   => $message
                ]);
            }
        } else {
            tao_thongdiep(arraybien('Gửi thất bại'), 'error');
        }

        (new RedirectResponse(url()))->send();
    }

    /**
     * Ẩn form sau khi gửi xong
     *
     * @return void
     */
    protected function forceHide()
    {
        Session::forget(static::$sessionName);
        Session::set(static::$sessionName, false);
    }

    /**
     * Render kèm nút gọi form nằm dưới website
     *
     * @return $this
     */
    public function withButton()
    {
        $this->withButton = true;

        return $this;
    }
}
