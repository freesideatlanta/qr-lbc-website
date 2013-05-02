<?php 


echo validation_errors();

echo form_open('contact');

echo form_label('What is your E-mail?', 'email');
echo form_input(array(
    'name'=>'email',
    'value'=>set_value('email')
));

echo form_label('Subject', 'subject');
echo form_input(array(
    'name'=>'subject',
    'value'=>set_value('subject')
));

echo form_label('Message', 'message');
echo form_textarea(array(
    'name'=>'message',
    'value'=>set_value('message'),
    'rows'=>'20',
    'cols'=>'60',
));

echo form_submit('submit','Send Message');
echo form_close();
