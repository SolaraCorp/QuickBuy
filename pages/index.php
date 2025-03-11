<?php
require_once '../config/database.php';

//conecta com o banco de dados
$database = new Database();
$db = $database->getConnection();

//busca todos os produtos
$query = "SELECT * FROM products";
$stmt = $db->prepare($query);
$stmt->execute();
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../styles/style.css">
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700&display=swap" rel="stylesheet">
        <title>QuickBuy - Home</title>
    </head>
    <body>
        <header>
            <a class="logo-name" href="index.php">
                <img id="logo" src="../images/header/QuickBuy-logo.png">
                <img id="name" src="../images/header/QuickBuy-Name(3).png">
            </a>
            <div class="search-bar">
                <input type="text" id="search-box" placeholder="Pesquise algo...">
                <button class="search-button" id="s-button"><img src="../images/header/procurar.png" height="50vh"></button>
            </div>
            <div class="header-options">
                <div class="profile-dropdown">
                    <button class="profile-button" onclick="toggleDropdown()"><img src="../images/header/perfil.png"></button>
                    <div class="dropdown-content">
                        <a href="profile.html">Meu Perfil</a>
                        <a href="purchases.html">Minhas Compras</a>
                        <a href="payment-methods.html">Formas de Pagamento</a>
                    </div>
                </div>
                <button class="chart-button"><img src="../images/header/carrinho-de-compras (2).png"></button>
            </div>
        </header>
        <main id="main">
            <div class="cards-section">
                <span class="title">Destaques</span>
                <div class="card-roll">
                    <?php foreach($products as $product): ?>
                        <a href="product.php?id=<?php echo $product['id_product']; ?>" class="card">
                            <img src="<?php echo empty($product['image_url']) ? '../images/body/placeholder-product.png' : $product['image_url']; ?>" 
                                 onerror="this.src='../images/body/placeholder-product.png'" 
                                 alt="<?php echo htmlspecialchars($product['name']); ?>">
                            <span class="product-name"><?php echo htmlspecialchars($product['name']); ?></span>
                            <span class="product-price"><small>R$</small><?php echo number_format($product['price'], 2, ',', '.'); ?></span>
                            <span class="shipping-info">Frete grátis</span>
                        </a>
                    <?php endforeach; ?>
                </div>
                <button class="roll-button" id="button-left" onclick="roll(-1)"><img src="../images/body/left-arrow.png"></button>
                <button class="roll-button" id="button-right" onclick="roll(1)"><img src="../images\body\right-arrow.png"></button>
            </div>
        </main>
        <script src="../scripts/dropdown-behavior.js"></script>
        <script src="../scripts/cards-roll-behavior.js"></script>
    </body>
</html> 