# contactform
ContactForm


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
| `description(string $description)` | Gán mô tả cho form |
| `isSendMail(bool $isSend = true)` | Bật, tắt gửi email sau khi gửi thành công |
| `keyReplace(string $keyReplace)` | Gán từ khóa để thay thế trong nội dung gửi email |
| `subject(string $subject)` | Gán tiêu đề gửi email |
| `message(string $message)` | Gán nội dung gửi email |
| `method(string $method)` | Gán method cho form (GET, POST) |
| `action(string $action)` | Gán action cho form |
| `table(string $table)` | Gán tên bảng |
| `setNumberShow(int $showRepeat)` | Gán số lần hiện form sau khi tải trang |
| `buttonZindex(int $zindex)` | zindex của nút gọi form |
| `buttonLabel(string $label)` | Nhãn của nút gọi form |
| `buttonIcon(string $icon)` | Gán icon của nút gọi form |
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
| `git status` | List all *new or modified* files |
| `git diff` | Show file differences that **haven't been** staged |



