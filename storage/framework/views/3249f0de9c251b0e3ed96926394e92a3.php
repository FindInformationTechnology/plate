<!DOCTYPE html>
<html lang="<?php echo new \Illuminate\Support\EncodedHtmlString(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo new \Illuminate\Support\EncodedHtmlString(config('app.name')); ?></title>
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            background-color: #f4f6f8;
            margin: 0;
            padding: 40px 20px;
            color: #333333;
            -webkit-font-smoothing: antialiased;
        }
        .email-wrapper {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            overflow: hidden;
            padding: 40px 20px;
        }
        .header {
            background-color: #ffffff;
            padding: 30px 20px;
            text-align: center;
            /* border-bottom: 1px solid #eeeeee; */
        }
        .logo {
            max-width: 150px;
            height: auto;
        }
        .content {
            padding: 40px 40px;
            text-align: center;
        }
        h1 {
            color: #127384;
            margin-top: 0;
            margin-bottom: 20px;
            font-size: 24px;
            font-weight: bold;
        }
        p {
            margin: 0 0 20px;
            color: #555555;
            font-size: 16px;
            line-height: 1.6;
        }
        .button {
            display: inline-block;
            background-color: #127384;
            color: #ffffff !important;
            text-decoration: none;
            padding: 12px 30px;
            border-radius: 6px;
            font-weight: bold;
            margin-top: 10px;
            margin-bottom: 30px;
            text-align: center;
        }
        .footer {
            background-color: #f9f9f9;
            padding: 20px;
            text-align: center;
            font-size: 12px;
            color: #999999;
            border-top: 1px solid #eeeeee;
        }
        .subcopy {
            margin-top: 25px;
            padding-top: 25px;
            border-top: 1px solid #eeeeee;
            font-size: 12px;
            color: #999999;
            text-align: center;
        }
        .subcopy p {
            font-size: 12px;
            color: #999;
            margin-bottom: 10px;
        }
        .break-all {
            word-break: break-all;
            color: #127384;
            text-decoration: none;
        }
        @media only screen and (max-width: 600px) {
            body {
                padding: 20px 10px;
            }
            .content {
                padding: 30px 20px;
            }
        }
    </style>
</head>
<body>
    <div class="email-wrapper">
        <div class="header">
            <a href="<?php echo new \Illuminate\Support\EncodedHtmlString(url('/')); ?>" target="_blank">
                <img src="<?php echo new \Illuminate\Support\EncodedHtmlString(asset('assets/img/logo-b.png')); ?>" alt="<?php echo new \Illuminate\Support\EncodedHtmlString(config('app.name')); ?>" class="logo">
            </a>
        </div>
        
        <div class="content">
            <h1>
                <?php if(! empty($greeting)): ?>
                    <?php echo new \Illuminate\Support\EncodedHtmlString($greeting); ?>

                <?php else: ?>
                    <?php if($level === 'error'): ?>
                        <?php echo app('translator')->get('Whoops!'); ?>
                    <?php else: ?>
                        <?php echo app('translator')->get('Hello!'); ?>
                    <?php endif; ?>
                <?php endif; ?>
            </h1>

            
            <?php $__currentLoopData = $introLines; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $line): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <p><?php echo new \Illuminate\Support\EncodedHtmlString($line); ?></p>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            
            <?php if(isset($actionText)): ?>
                <a href="<?php echo new \Illuminate\Support\EncodedHtmlString($actionUrl); ?>" class="button" target="_blank"><?php echo new \Illuminate\Support\EncodedHtmlString($actionText); ?></a>
            <?php endif; ?>

            
            <?php $__currentLoopData = $outroLines; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $line): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <p><?php echo new \Illuminate\Support\EncodedHtmlString($line); ?></p>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            
            <p style="margin-top: 30px; font-weight: 500;">
                <?php if(! empty($salutation)): ?>
                    <?php echo new \Illuminate\Support\EncodedHtmlString($salutation); ?>

                <?php else: ?>
                    <?php echo app('translator')->get('Regards,'); ?><br>
                    <?php echo new \Illuminate\Support\EncodedHtmlString(config('app.name')); ?>

                <?php endif; ?>
            </p>

            
            <?php if(isset($actionText)): ?>
                <div class="subcopy">
                    <p>
                        <?php echo app('translator')->get(
                            "If you're having trouble clicking the \":actionText\" button, copy and paste the URL below into your web browser:",
                            [
                                'actionText' => $actionText,
                            ]
                        ); ?>
                    </p>
                    <a href="<?php echo new \Illuminate\Support\EncodedHtmlString($actionUrl); ?>" class="break-all"><?php echo new \Illuminate\Support\EncodedHtmlString($displayableActionUrl); ?></a>
                </div>
            <?php endif; ?>
        </div>
        
        <div class="footer">
            <p style="margin-bottom: 5px;">&copy; <?php echo new \Illuminate\Support\EncodedHtmlString(date('Y')); ?> <?php echo new \Illuminate\Support\EncodedHtmlString(config('app.name')); ?>. <?php echo app('translator')->get('All_Rights_Reserved'); ?></p>
        </div>
    </div>
</body>
</html>
<?php /**PATH C:\Users\dell\Desktop\plate\resources\views/vendor/notifications/email.blade.php ENDPATH**/ ?>