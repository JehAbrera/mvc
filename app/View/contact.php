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
            <div class=" w-4/5 h-3/5 grid grid-cols-2 text-slate-950">
                <div class=" flex justify-center items-center order-2">
                    <img src="../../public/images/person.png" alt="image" class=" w-4/5">
                </div>
                <div class=" flex flex-col items-center justify-between bg-zinc-100 rounded-xl p-4">
                    <div class=" flex flex-col w-full items-center">
                        <span class=" font-bold text-2xl border-b-2 border-b-slate-950 w-full text-center">Contact Us!</span>
                        <span class=" chat-header">We'd like to hear from you.</span>
                    </div>
                    <div class=" flex flex-col w-full mockup-code bg-white text-slate-950 p-4">
                        <pre><span>Call us: 0912-345-6789</span></pre>
                        <div class=" divider">or</div>
                        <pre><span>Email us: sample_mail@gmail.com</span></pre>
                    </div>
                    <div class=" w-full flex flex-col items-center">
                        <span class=" divider">Get the latest news</span>
                        <div class="join">
                            <input class="input input-bordered join-item rounded-full" placeholder="Email" />
                            <button class="btn btn-primary join-item rounded-r-full">Subscribe</button>
                        </div>
                    </div>
                </div>
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