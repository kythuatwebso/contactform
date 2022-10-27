# contactform


### Cài đặt
```
composer require websovn/contactform
```

## Hướng dẫn - Có 2 phương thức chính để gọi:
## Render form
```
{\Websovn\ContactForm::make()
  ->action(url(''))
  ->setNumberShow(1)
  ->withButton()
  ->render()}
```
#### Phương thức của Render
| Phương thức | Mô tả |
| --- | --- |
| `static function make()` | Khởi tạo |
| `description(string $description)` | Set mô tả cho form |
| `method(string $method)` | Set method cho form (GET, POST) |
| `action(string $action)` | Set action cho form |
| `table(string $table)` | Set tên bảng |
| `setNumberShow(int $showRepeat)` | Set số lần hiện form sau khi tải trang |
| `buttonZindex(int $zindex)` | zindex của nút gọi form |
| `buttonLabel(string $label)` | Nhãn của nút gọi form |
| `buttonIcon(string $icon)` | Set icon của nút gọi form |
| `buttonClassWrap(string $class)` | Set class div bao nút gọi form |
| `buttonClass(string $class)` | Set class nút gọi form |
| `function withButton()` | Hiển thị nút gọi form |
| `function render()` | Render form ra view |



## Xử lý form
```
\Websovn\ContactForm::make()->query(request());
```
#### Phương thức của Query
| Command | Description |
| --- | --- |
| `static function make()` | Khởi tạo |
| `isSendMail(bool $isSend = true)` | Bật, tắt gửi email sau khi gửi thành công |
| `keyReplace(string $keyReplace)` | Set từ khóa để thay thế trong nội dung gửi email |
| `subject(string $subject)` | Set tiêu đề gửi email |
| `message(string $message)` | Set nội dung gửi email |
| `query(Request $request)` | Xử lý form |



