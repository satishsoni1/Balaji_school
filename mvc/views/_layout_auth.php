<?php echo doctype("html5"); ?>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <meta name="theme-color" content="#3f0d13">
    <title><?=$authTitle?> | <?=namesorting($siteinfos->sname, 40)?></title>
    <link rel="SHORTCUT ICON" href="<?=base_url("uploads/images/$siteinfos->photo")?>" />
    <link href="<?php echo base_url('assets/bootstrap/bootstrap.min.css'); ?>" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url('assets/fonts/font-awesome.css'); ?>" rel="stylesheet" type="text/css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,600&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap">
    <link href="<?php echo base_url('assets/inilabs/auth.css').'?v='.filemtime(FCPATH.'assets/inilabs/auth.css'); ?>" rel="stylesheet" type="text/css">
</head>

<body class="auth-body">
    <div class="auth">
        <aside class="auth__visual">
            <a class="auth__brand" href="<?=base_url()?>">
                <?php if(customCompute($siteinfos->photo)) { ?>
                    <img src="<?=base_url('uploads/images/'.$siteinfos->photo)?>" alt="">
                <?php } ?>
                <span>
                    <strong><?=$siteinfos->sname?></strong>
                    <small>School management portal</small>
                </span>
            </a>

            <div class="auth__quote">
                <span class="eyebrow">Students &middot; Parents &middot; Teachers &middot; Staff</span>
                <h1>Achieving the impossible through dedication and determination</h1>
                <p>Attendance, exams, marks, fees, notices and more &mdash; everything for the school community in one place.</p>
            </div>

            <a class="auth__back" href="<?=base_url()?>"><i class="fa fa-arrow-left"></i> Back to school website</a>
        </aside>

        <main class="auth__main">
            <div class="auth__card">
                <a class="auth__mobile-brand" href="<?=base_url()?>">
                    <?php if(customCompute($siteinfos->photo)) { ?>
                        <img src="<?=base_url('uploads/images/'.$siteinfos->photo)?>" alt="">
                    <?php } ?>
                    <span>
                        <strong><?=namesorting($siteinfos->sname, 40)?></strong>
                        <small>School management portal</small>
                    </span>
                </a>

                <?php $this->load->view($subview); ?>

                <p class="auth__footnote">Trouble signing in? Please contact the school office.</p>
            </div>

            <?php if(!empty($showDemo) && config_item('demo')) { ?>
                <div class="auth__demo">
                    <p>For a quick demo login, choose a role:</p>
                    <button class="btn btn-sm btn-primary" id="admin">Admin</button>
                    <button class="btn btn-sm btn-info" id="teacher">Teacher</button>
                    <button class="btn btn-sm btn-warning" id="student">Student</button>
                    <button class="btn btn-sm btn-success" id="parent">Parent</button>
                    <button class="btn btn-sm btn-danger" id="accountant">Accountant</button>
                    <button class="btn btn-sm btn-default" id="librarian">Librarian</button>
                    <button class="btn btn-sm btn-primary" id="recep">Receptionist</button>
                </div>
            <?php } ?>
        </main>
    </div>

    <script type="text/javascript" src="<?php echo base_url('assets/inilabs/jquery.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/bootstrap/bootstrap.min.js'); ?>"></script>
    <script type="text/javascript">
        $(document).on('click', '[data-toggle-password]', function () {
            var input = $(this).siblings('input');
            var show = input.attr('type') === 'password';
            input.attr('type', show ? 'text' : 'password');
            $(this).attr('aria-label', show ? 'Hide password' : 'Show password')
                .find('.fa').toggleClass('fa-eye', !show).toggleClass('fa-eye-slash', show);
        });
        $('form').on('submit', function () {
            $(this).find('input[type=submit]').prop('disabled', true).val('Please wait…');
        });
    </script>

    <?php if(!empty($showDemo) && config_item('demo')) { ?>
        <script type="text/javascript">
            var demoUsers = {admin: 'admin', teacher: 'teacher1', student: 'student1', parent: 'parent1', accountant: 'accountant', librarian: 'librarian', recep: 'receptionist'};
            $.each(demoUsers, function (id, username) {
                $('#' + id).click(function () {
                    $("input[name=username]").val(username);
                    $("input[name=password]").val('123456');
                });
            });
        </script>
    <?php } ?>
</body>
</html>
