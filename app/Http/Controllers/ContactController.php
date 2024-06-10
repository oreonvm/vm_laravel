<?php

namespace App\Http\Controllers;

use App\Mail\TestMail;
use App\Models\Contact;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Mail\Mailables\Attachment;

class ContactController extends Controller
{

    // public function index()
    // {
    //     $user = auth()->user();
    //     return view('home.contact')
    // }

    public function poslatyPtichku()
    {
        // ========>> Sending mail using Laravel doesn't work  - getting an error ?!?! ====================
        //     $data = [
        //         'title' => 'Mail from Support Laravel ',
        //         'body' => 'This is for testing email from vm_laravel using smtp.'
        //     ];
        //     // Mail::to('healthylifestyle451@gmail.com')->send(new TestMail($data));
        //     $emails = ['On@yandex.ru', 'on@gmail.com'];
        //      $emails = implode(' ,', $emails);
        //     if($emails) {
        //   // =========================>> This not working ===============================
        //      Mail::to( $emails )->send(new TestMail($data));
        //   return view('email.test', compact('data'))->with('status', 'Message send successfully!!!');
        //     } else { return 'Сообщение не отправилено!!';}

        //  ========>>>  Sending mail  in format html using function mail() work successfully  !!! ==================
        $sender = "Laravel";
        $email = "support@laravel.health-spiritual.com";
        $sub = "TEST email from support laravel";
        $mes = "<p><strong><span style='color: green'>Lorem ipsum dolor sit amet, consectetur adipisicing elit,</span></strong><br> sed do eiusmod
	tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
	quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
	consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
	cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
	proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>";

        $headers = "Content-type:text/html; charset = UTF-8\r\nFrom:$sender <contact>\r\nReply-To:$email";
        $headers .= "Content-Type: multipart/form-data\r\n";
        // attachment  ======>> not working  ?!?!  ========
        $attachment = chunk_split(base64_encode(file_get_contents('./images/1-interior-8.jpg')));
        // $mes .= $attachment . "\r\n";

        $addresses = ['On@yandex.ru', 'on@gmail.com'];
        $addresses = implode(' ,', $addresses);
        if ($addresses) {
            $sent = mail($addresses, $sub, $mes, $headers);
            return redirect('/')->with('status', 'Mail send successfully!!!');
            //	return view('email.test', compact('sender', 'email', 'sub', 'mes'));
        } else {
            return 'Сообщение не отправилено!!';
        }
    }

    // ===>> Receiving email with a screenshot from USERS using function mail() without attachmentt ========
    public function store(Request $request)
    {
        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'email',
            'subject' => 'required',
            'message' => 'required',
            'image'  => 'image',
        ]);

        $data = $request->all();
        if ($request->hasFile('image')) {
            $folder = date('Y-m-d');
            $data['image'] = $request->file('image')->store("images/{$folder}");
        }
        // dd($data); //=====>> Array all requests =========
        $contact = Contact::create($data);

        if ($request->method() == 'POST') {
            $first_name = "Name {$request->input('first_name')}";
            $last_name = $request->input('last_name');
            $email = "Email {$request->input('email')}";
            $sub = "Laravel: {$request->input('subject')}";
            $headers = "Content-type:text/plain; charset = UTF-8\r\nFrom:$first_name' '$last_name<contact>\r\nReply-To:$email";
            // $headers .= "Content-Type: multipart/form-data\r\n\n";
            $mes = "<p><br>" . nl2br($request->input('message')) . "</p><br><br>";
            $data['image'] = htmlspecialchars_decode(asset('storage/' . $data['image']));
            $mes .= "\n\n" . $data['image'];
            $mes = strip_tags($mes);
            $address = 'support@laravel.health-spiritual.com';
            //   $sent = mail($address, $sub, $mes, "Content-type:text/plain; charset = UTF-8\r\nFrom:$first_name' '$last_name<contact>\r\nReply-To:$email");
            $sent = mail($address, $sub, $mes, $headers);
            // ================>> Receiving mail using Laravel doesn't work  - getting an error ?!?! ===============
            //       Mail::to('support@laravel.health-spiritual.com')->send(new MessageUser($data));

            return redirect('/contact')->with('status', 'Mail send successfully!!!');
        }
        return View('home.contact', ['title' => 'Contact page', 'description' => 'Contact us']);
    }

    // =================>>> Test sending mail ========================
    public function send()
    {

        $data = [
            'title' => 'Mail from John Doe ',
            'body' => 'This is for testing email from vm_laravel using smtp.'
        ];
        Mail::to(['On@yandex.ru', 'on@gmail.com'])->send(new TestMail($data));

        //  dd('Mail send successfully.');
        return view('email.test', compact('data'))->with('status', 'Message send successfully!!!');
    }
    //================>>  Sending mail with attachment not working ?!?!?! =================
    public function sendWithAttachment()
    {
        // recipient email address
        $addresses = ['On@yandex.ru', 'on@gmail.com'];
        $addresses = implode(' ,', $addresses);

        // subject of the email
        $subject = "TEST email from support laravel with Attachment";

        // message body
        $message = "<p><strong><span style='color: green'>Lorem ipsum dolor sit amet, consectetur adipisicing elit,</span></strong><br> sed do eiusmod
	tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
	quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
	consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
	cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
	proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>";

        // from
        $from = "support@laravel.health-spiritual.com";
        $sender = "Laravel";
        $email = "support@laravel.health-spiritual.com";
        $sub = "TEST email from support laravel";
        $headers = "Content-type:text/html; charset = UTF-8\r\nFrom:$sender <contact>\r\nReply-To:$email";
        $headers .= "Content-Type: multipart/form-data\r\n";

        // attachment
        $attachment = chunk_split(base64_encode(file_get_contents('./images/1-interior-8.jpg')));
        $message .= $attachment . "\r\n";
        $message .= "Content-Type: text/html; charset=UTF-8\r\n";
        $message .= "Content-Transfer-Encoding: base64\r\n\r\n";
        $message .= chunk_split(base64_encode($message));
        // $message .= "--" . $boundary . "\r\n";
        $message .= "Content-Type: application/octet-stream; name=\"1-interior-8.jpg\"\r\n";
        $message .= "Content-Transfer-Encoding: base64\r\n";
        $message .= "Content-Disposition: attachment; filename=\"1-interior-8.jpg\"\r\n\r\n";

        if (mail($addresses, $subject, $message, $headers)) {
            // echo "Email with attachment sent successfully.";
            return redirect('/')->with('status', 'Email with attachment sent successfully!!');
        } else {
            echo "Failed to send email with attachment.";
        }
    }
}
