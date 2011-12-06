# PHP Secret Santa #
A simple online PHP Secret Santa Appliction.

To deploy the PHP Secret Santa Application on to your own PHP Enabled webhost, simply upload the index.php and SecretSanta.class.php files in to be web accessible directory on your site. 

Its recommended that you update the "from" address used in the tool by changing the value on line 34 of index.php to use an email address relevant to your site.

    $santa->setFrom('Name of Sender','email_of_sender@yoursite.com');

If you'd like to integrate PHP Secret Santa with an existing system (or simply use your own front end), the SecretSanta.class.php is easy to interact with.

A basic example of SecretSanta.class.php's usage is:

    $santa = new SecretSanta();
    $santa->run(
        array(
            array('name'=>'Bob', 'email'=> 'bob@bobnet.sample'),
            array('name'=>'Dave Daveworth', 'email'=> 'dave@davenet.sample')
        )
    );
	
### Licence

PHP Secret Santa is free to use/run/modify/redistribute/break under the terms of the MIT License.

Copyright (C) 2011 by Carl Saggs

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.