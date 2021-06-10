<?php session_start(); ?><!DOCTYPE html>
<html lang="en">
    <head>
        <?php
            include_once(__DIR__.'/../../../assets/common/global_private.php');
            include_once(__DIR__ . '/../../../assets/common/panel/vendors.php');
            include_once(__DIR__.'/../../../assets/common/panel/theme.php');
            include_once(__DIR__.'/../../../assets/common/processes/pages.php');
            include_once(__DIR__.'/../../../assets/common/processes/gui/pages.php');
        ?>

        <title>Articles - Saturn Panel</title>

        <?php
        if(isset($_GET['error'])) {
            $error = $_GET['error'];
            if ($error == 'permission') {
                $errorMsg = "Error: You do not have the required permissions to do that.";
            } else if ($error == 'new') {
                $errorMsg = "Error: There was a problem creating a new article.";
            } else {
                $errorMsg = "Error: An unknown error occurred.";
            }
        }

        if(get_user_roleID($_SESSION['id']) < 3) {
            header('Location: '.CONFIG_INSTALL_URL.'/panel/pages?error=permission');
        }

        if(CONFIG_ARTICLE_APPROVALS) {
            $yellowMsg = '<span class="text-yellow-500">Yellow:</span> Pending Approval<br>';
        } else {
            $yellowMsg = '<span class="text-yellow-500">Yellow:</span> Pending Publication<br>';
        }

        $key = '<div class="text-xs text-left absolute bottom-2 left-0 h-16 w-30 p-2 bg-gray-50 rounded">
                                                                    <span class="text-red-500">Red:</span> No Content<br>
                                                                    '.$yellowMsg.'
                                                                    <span class="text-green-500">Green:</span> Currently Live<br>
                                                                    <i>You can edit pending pages.</i>
                                                                </div>';

        if(isset($_POST['publish'])) {
            $id = checkInput('DEFAULT', $_GET['id']);
            if(get_article_author_id($id) == $_SESSION['id']) {
                if(update_article_status($id, 'PUBLISHED')) {
                    $successMsg = 'Article published.';
                } else {
                    $errorMsg = 'An error occurred.';
                }
            } else {
                $errorMsg = 'You can\'t publish articles that you don\'t own.';
            }
        }

        if(isset($_POST['delete'])) {
            $id = checkInput('DEFAULT', $_GET['id']);
            if(get_article_author_id($id) == $_SESSION['id']) {
                if(update_article_status($id, 'DELETED') && update_article_content($id, '') && update_article_references($id, '')) {
                    $successMsg = 'Article deleted.';
                } else {
                    $errorMsg = 'An error occurred.';
                }
            } else {
                $errorMsg = 'You can\'t delete articles that you don\'t own.';
            }
        }

        if(isset($_POST['hide'])) {
            $id = checkInput('DEFAULT', $_GET['id']);
            if(get_article_author_id($id) == $_SESSION['id']) {
                if(update_article_status($id, 'UNPUBLISHED')) {
                    $successMsg = 'Article hidden.';
                } else {
                    $errorMsg = 'An error occurred.';
                }
            } else {
                $errorMsg = 'You can\'t hide articles that you don\'t own.';
            }
        }

        if(isset($_POST['savesettings'])) {
            $id = checkInput('DEFAULT', $_GET['id']);
            $author = checkInput('DEFAULT', $_POST['users']);
            if(get_article_author_id($id) == $_SESSION['id']) {
                if(update_article_author($id, $author)) {
                    $successMsg = 'Article settings updated.';
                } else {
                    $errorMsg = 'An error occurred.';
                }
            } else {
                $errorMsg = 'You can\'t change settings for articles that you don\'t own.';
            }
        }
        ?>

    </head>
    <body class="mb-8">
        <?php include_once(__DIR__.'/../../../assets/common/panel/navigation.php'); ?>

        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                <h1 class="text-3xl font-bold leading-tight text-gray-900">Articles</h1>
            </div>
        </header>

        <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <?php
        if(isset($errorMsg)){
            alert('ERROR',$errorMsg);
        }
        unset($errorMsg);
        if(isset($successMsg)){
            alert('SUCCESS',$successMsg);
        }
        unset($successMsg);
        ?>
            <div class="px-4 py-6 sm:px-0">
                <?php
                $role = get_user_roleID($_SESSION['id']);
                $i=1;
                $article = get_article_title($i);
                while($article != null) {
                    if(get_article_status($i) == 'PENDING') {
                        echo '            <div>
                                    <div name="' . $article . '" id="' . $article . '">
                                        <div class="flex-grow relative pt-1 mb-2">
                                            <div class="flex items-center justify-between">
                                                <h1 class="text-xl font-bold leading-tight text-gray-900 mr-2">' . $article . '</h1>
                                            <div>
                                            <div class="flex items-center justify-between space-x-2">
                                                <span class="text-xs font-semibold inline-block py-1 px-2 uppercase rounded-full text-yellow-500 bg-yellow-200">Pending</span>
                                                <a href="' . CONFIG_INSTALL_URL . '/panel/articles/approvals/approve/?articleID=' . $i . '" class="hover:shadow-lg cursor-pointer w-full flex items-center justify-center px-8 py-1 border border-transparent text-base font-medium rounded-md text-' . THEME_PANEL_COLOUR . '-700 bg-' . THEME_PANEL_COLOUR . '-100 hover:bg-' . THEME_PANEL_COLOUR . '-200 transition-all duration-200 md:py-1 md:text-rg md:px-10 h-full">
                                                    Approve
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <hr><br>';
                }
                unset($article);
                $i++;
                $article = get_article_title($i);
            }
            ?>
        </div>
    </body>
</html>