<?php
$homeTitle = "Bienvenue sur notre site de santé";
$homeDescription = "Explorez les informations les plus récentes sur la santé et le bien-être.";

$section1Title = "Section 1";
$section1Description = "Description of Section 1";

$section2Title = "Section 2";
$section2Description = "Description of Section 2";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dynamic Health Website</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <?php include 'navbar.php'; ?>
    
    <section class="home" style="background-image: url('homebackground.jpg');">
        <div class="content">
            <h1><?php echo $homeTitle; ?></h1>
            <p><?php echo $homeDescription; ?></p>
        </div>
    </section>

    <section class="section-1" style="background-image: url('section-1-bg.jpg');">
        <div class="content">
            <h2><?php echo $section1Title; ?></h2>
            <p><?php echo $section1Description; ?></p>
        </div>
    </section>

    <section class="section-2" style="background-image: url('section-2-bg.jpg');">
        <div class="content">
            <h2><?php echo $section2Title; ?></h2>
            <p><?php echo $section2Description; ?></p>
        </div>
    </section>

    <?php include 'footer.php'; ?>
</body>
</html>
