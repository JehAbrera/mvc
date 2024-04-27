<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../public/css/output.css">
    <title>Home</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins&display=swap');

        * {
            font-family: "Poppins", sans-serif;
        }

        /* Change Image here of hero section on other page */
        body {
            background: linear-gradient(to right bottom, rgba(2, 6, 23, 0), rgba(2, 6, 23, 1.0)), url('../../public/images/sunset.jpg') center/cover no-repeat fixed;
        }
    </style>
</head>
<body class=" w-full min-h-screen flex flex-col">
    <?php
        include 'nav.php';
    ?>
    <main>
        <section role="hero" id="hero" class=" h-screen w-full flex flex-col items-center justify-center">
            <div class=" flex flex-col w-full text-zinc-100 items-end p-4">
                <span class=" font-semibold text-2xl">Make your sunsets a little more</span>
                <span class=" font-extrabold text-9xl">SPECIAL</span>
                <span>Where every day ends with a masterpiece. Sunset City Suites: Your haven in the heart of tranquility.</span>
                <button class=" btn btn-accent mt-6" onclick=" location.href = 'Profile.php'">Discover more!</button>
            </div>
        </section>
    </main>
    <!-- Icon CDN # Source: Lucide.dev -->
    <!-- Development version -->
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>

    <!-- Production version -->
    <script src="https://unpkg.com/lucide@latest"></script>
    <script>
        lucide.createIcons();
    </script>
</body>
</html>