<?php

namespace App\Actions\Seed;

use App\Models\Faq;
use App\Models\User;

class BaseFaqSeeder
{
    public static function execute(User $user)
    {
        Faq::create([
            'title'      => 'How do I contact support?',
            'created_by' => $user->id,
            'detail'     => "
                <p>Hey there! We're sorry you're experiencing issues, but our Customer Support is here to help.</p><p>Please use the <b>Support </b>page on the <a href='https://imagesourceinc.com/' target='_blank'>ImageSource website here</a>.</p>
            "
        ]);

        Faq::create([
            'title'      => 'Where can I find the latest information on customer experience solutions?',
            'created_by' => $user->id,
            'detail'     => "
                <p style=1\1 margin-right:1=11 0px;=11 margin-bottom:=11 15px;=11 margin-left:=11 padding:=11 text-align:=11 justify;=11 font-family:=11 1open=11 sans1,=11 arial,=11 sans-serif;=11 font-size:=11 14px;\1=11>Check out the Blogs area on the <a href=1https://blog.imagesourceinc.com/blog1 target=1_blank1>ImageSource website</a>!</p>
            "
        ]);

        Faq::create([
            'title'      => 'Who is ImageSource?',
            'created_by' => $user->id,
            'detail'     => "
                <p><b style='color: rgb(8, 82, 148);'>ImageSource is the manufacturer of ILINX Software. We are the leading independent platform provider and integrator of document and data capture, workflow and business process automation.</b></p><p>Founded in 1994, ImageSource is a privately held, founder-led corporation in Olympia, WA. ImageSource is a leader in Digital Transformation solutions through both organic and strategic growth initiatives. ImageSource manufactures the ILINX platform, built from the ground up to automate business processes, connect systems and make data usable for organizations ranging from SMBs to State Governments to Fortune 500 companies.<br></p>
            "
        ]);
    }
}
