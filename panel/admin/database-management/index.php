<?php
session_start();

ob_start();
require_once __DIR__.'/../../../common/global_private.php';
require_once __DIR__.'/../../../common/admin/global.php';
ob_end_flush();

require_once __DIR__.'/../../../common/processes/gui/modals.php';

function optimise_tables(): bool
{
    global $conn;

    $query1 = 'OPTIMIZE TABLE `'.DATABASE_PREFIX.'announcements`';
    $query2 = 'OPTIMIZE TABLE `'.DATABASE_PREFIX.'articles`';
    $query3 = 'OPTIMIZE TABLE `'.DATABASE_PREFIX.'chats_messages`';
    $query4 = 'OPTIMIZE TABLE `'.DATABASE_PREFIX.'notifications`';
    $query5 = 'OPTIMIZE TABLE `'.DATABASE_PREFIX.'pages`';
    $query6 = 'OPTIMIZE TABLE `'.DATABASE_PREFIX.'pages_authors`';
    $query7 = 'OPTIMIZE TABLE `'.DATABASE_PREFIX.'pages_history`';
    $query8 = 'OPTIMIZE TABLE `'.DATABASE_PREFIX.'pages_pending`';
    $query9 = 'OPTIMIZE TABLE `'.DATABASE_PREFIX.'pages_statistics`';
    $query10 = 'OPTIMIZE TABLE `'.DATABASE_PREFIX.'todo_items`';
    $query11 = 'OPTIMIZE TABLE `'.DATABASE_PREFIX.'todo_lists`';
    $query12 = 'OPTIMIZE TABLE `'.DATABASE_PREFIX.'users`';
    $query13 = 'OPTIMIZE TABLE `'.DATABASE_PREFIX.'users_settings`';
    $query14 = 'OPTIMIZE TABLE `'.DATABASE_PREFIX.'users_statistics`';

    return mysqli_query($conn, $query1) &&
        mysqli_query($conn, $query2) &&
        mysqli_query($conn, $query3) &&
        mysqli_query($conn, $query4) &&
        mysqli_query($conn, $query5) &&
        mysqli_query($conn, $query6) &&
        mysqli_query($conn, $query7) &&
        mysqli_query($conn, $query8) &&
        mysqli_query($conn, $query9) &&
        mysqli_query($conn, $query10) &&
        mysqli_query($conn, $query11) &&
        mysqli_query($conn, $query12) &&
        mysqli_query($conn, $query13) &&
        mysqli_query($conn, $query14);
}

if (isset($_GET['action']) && $_GET['action'] == 'optimise') {
    if (optimise_tables()) {
        $successMsg = __('Admin:Database_Optimised');
        log_file('Saturn', get_user_fullname($_SESSION['id']).' '.__('Admin:Database_OptimisedLog'));
    } else {
        $errorMsg = __('Error:DatabaseOptimisation');
    }
}
?><!DOCTYPE html>
<html lang="en">
    <head>
        <?php include __DIR__.'/../../../common/panel/vendors.php'; ?>

        <title><?php echo __('Admin:Database_Management'); ?> - <?php echo CONFIG_SITE_NAME.' '.__('Admin:Panel'); ?></title>
        <?php require __DIR__.'/../../../common/panel/theme.php'; ?>

    </head>
    <body class="bg-gray-200">
        <?php require __DIR__.'/../../../common/admin/navigation.php'; ?>

        <div class="px-8 py-4 w-full">
            <h1 class="text-gray-900 text-3xl"><?php echo __('Admin:Database_Management'); ?></h1>
            <?php
            if (isset($errorMsg)) {
                echo alert('ERROR', $errorMsg);
                log_error('ERROR', $errorMsg);
                unset($errorMsg);
            }
            if (isset($successMsg)) {
                echo alert('SUCCESS', $successMsg);
                unset($successMsg);
            }
            ?>
            <h2 class="text-gray-900 text-2xl mt-8"><?php echo __('Admin:Database_TableOverhead'); ?></h2>
            <p class="text-xs"><?php echo __('Admin:Database_TableOverhead_Message'); ?></p>
            <div class="grid grid-cols-2 lg:grid-cols-3">
            <?php
            $query = 'SHOW TABLE STATUS';
            $rs = mysqli_query($conn, $query);
            $row = mysqli_fetch_array($rs);
            while ($row['Name'] != null) {
                ?>
                <p><?php echo $row['Name']; ?>: <?php echo $row['Data_free']; ?><br>
                <?php
                $row = mysqli_fetch_array($rs);
            }
            ?>
            </div>
            <br>
            <a href="index.php/?action=optimise" class="flex-grow transition-all duration-200 hover:shadow-lg cursor-pointer w-full flex items-center justify-center px-8 py-1 border border-transparent text-base font-medium rounded-md text-gray-700 bg-gray-100 hover:bg-gray-200 md:py-1 md:text-rg md:px-10"><?php echo __('Admin:Database_Optimise'); ?></a>
        </div>
    </body>
</html>