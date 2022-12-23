

<p align="center"><a href="https://laravel.com/docs/9.x" target="_blank"><img src="https://img.shields.io/badge/Laravel | v 9.43-FFFFFF?style=for-the-badge&logo=laravel&logoColor=F80000" alt="Latest Stable Version"></a> <a href="https://www.php.net/releases/8.1/en.php" target="_blank"><img src="https://img.shields.io/badge/PHP | v 8.1.8-777BB4?style=for-the-badge&logo=php&logoColor=white" alt="Latest Stable Version"></a></p>


## Tutorial to replicate

### 1º Install Laravel
<pre>
composer create-project laravel/laravel your-project-name 
</pre>

### 2º Prepare .env to use queues with database
<pre>
QUEUE_CONNECTION=database
</pre>

### 3º Create migrations to be used in queues
<pre>
php artisan queue:table
</pre>
result: 
    \database\migrations\YYYY_MM_DD_TTTTTT_create_jobs_table.php
    
### 4º After creating the laravel Jobs migration, create the tables in the database
<pre>
php artisan migrate 
</pre> 

#### -- 5:  Change 'send' to 'queue' in your controller
###### Note: To learn how to use mail in Laravel use <a href="https://github.com/hodnan/laravel-mail">this tutorial (laravel-mail)</a>
<pre>
 Mail::send($content);
 to 
 Mail::queue($content);
</pre>

#### -- 6º Run queue 
###### Note: At this point your emails will be stored in the queue and executed along with it, however in case of failure new sending attempts will not be made. So let's use laravel Jobs.
<pre>  
php artisan queue:work 
</pre>

#### 7º Create a Job
<pre>
php artisan make:job MyMailJob
</pre>

#### 8º Configure your Job
##### 8.1 In your Job include the following lines
<pre>
use Illuminate\Support\Facades\Mail;
use App\Mail\NotifyMail;
</pre>

##### 8.2 Create this variable to control the number of attempts
<pre>
 private $tries = 3;
</pre>
##### 8.3 In our case we will use a constructor to receive our user
<pre>
 private $user;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(\stdClass $user)
    {
        $this->user = $user;
    }
</pre>
##### 8.4 In your handle call your email class
<pre>
 public function handle()
    {
        $content = new NotifyMail($this->user);
        Mail::send($content);
    }
</pre>