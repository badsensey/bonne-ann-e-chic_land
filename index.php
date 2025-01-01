<?php
$filePath = "messages.txt";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $newMessage = $_POST["message"] ?? '';
    if (!empty(trim($newMessage))) {
        file_put_contents($filePath, htmlspecialchars($newMessage) . PHP_EOL, FILE_APPEND);
    }
}

$messages = file_exists($filePath) ? file($filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) : [];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bonne Année - 𝖈𝖍𝖎𝖈✨_𝖑𝖆𝖓𝖉 ❤️🔥</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Ajoutez ici le style pour votre page */
        body {
            background: linear-gradient(to bottom, #1a1a1a, #660000);
            color: #fff;
            font-family: 'Arial', sans-serif;
            text-align: center;
        }
        h1 {
            font-family: 'Courier New', Courier, monospace;
            font-size: 3rem;
            margin-top: 20px;
        }
        .btn-custom {
            background-color: #ff6600;
            color: white;
        }
        #fireworks {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1; /* Derrière le contenu principal */
        }
    </style>
</head>
<body>
    <!-- Canevas pour les feux d'artifice -->
    <canvas id="fireworks"></canvas>

    <header>
        <h1>Bonne Année 2025 <span style="color: gold;">𝖈𝖍𝖎𝖈✨_𝖑𝖆𝖓𝖉 ❤️🔥</span> !</h1>
        <p>Que cette nouvelle année soit remplie de bonheur, de succès et de moments inoubliables avec notre groupe adoré !</p>
    </header>

    <!-- Nouveau bouton pour accéder à la page souvenir.html -->
    <div class="text-center mt-4">
        <a href="souvenir.html" class="btn btn-custom">Explorez Nos Chic✨ Souvenirs</a>
    </div>
    
    <main class="container my-5">
        <section class="mt-5">
            <h2>Extension du territoire 🫵 'Livre d'or 💬'</h2>

            <!-- Formulaire d'envoi -->
            <form action="index.php" method="post" class="my-4">
                <div class="mb-3">
                    <label for="message" class="form-label">Votre message :</label>
                    <textarea id="message" name="message" class="form-control" rows="4" placeholder="Écrivez vos vœux ici..."></textarea>
                </div>
                <button type="submit" class="btn btn-custom">Envoyer</button>
            </form>

            <!-- Afficher les messages -->
            <div class="mt-5">
                <h3>Chic messages reçus ✨ :</h3>
                <ul class="list-group">
                    <?php foreach ($messages as $msg): ?>
                        <li class="list-group-item"><?php echo htmlspecialchars($msg); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </section>
    </main>


    <footer>
        <p>&copy; 2025 𝖈𝖍𝖎𝖈✨_𝖑𝖆𝖓𝖉 ❤️🔥</p>
    </footer>

    <script>
        const canvas = document.getElementById("fireworks");
        const ctx = canvas.getContext("2d");

        canvas.width = window.innerWidth;
        canvas.height = window.innerHeight;

        const particles = [];

        class Particle {
            constructor(x, y, color) {
                this.x = x;
                this.y = y;
                this.radius = Math.random() * 2 + 1;
                this.color = color;
                this.velocityX = Math.random() * 4 - 2;
                this.velocityY = Math.random() * 4 - 2;
                this.alpha = 1; // Transparence
            }

            update() {
                this.x += this.velocityX;
                this.y += this.velocityY;
                this.alpha -= 0.01; // Disparition progressive
            }

            draw() {
                ctx.globalAlpha = this.alpha;
                ctx.beginPath();
                ctx.arc(this.x, this.y, this.radius, 0, Math.PI * 2);
                ctx.fillStyle = this.color;
                ctx.fill();
            }
        }

        function createFirework(x, y) {
            const colors = ["#ff6600", "#ffcc00", "#ffffff", "#ff0066", "#6600ff"];
            for (let i = 0; i < 50; i++) {
                const color = colors[Math.floor(Math.random() * colors.length)];
                particles.push(new Particle(x, y, color));
            }
        }

        function animate() {
            ctx.clearRect(0, 0, canvas.width, canvas.height);

            particles.forEach((particle, index) => {
                if (particle.alpha <= 0) {
                    particles.splice(index, 1); // Supprime les particules invisibles
                } else {
                    particle.update();
                    particle.draw();
                }
            });

            requestAnimationFrame(animate);
        }

        canvas.addEventListener("click", (e) => {
            createFirework(e.clientX, e.clientY);
        });

        animate();
    </script>
</body>
</html>
