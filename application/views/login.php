<?php
include('header.php');
?>
<li class="nav-item">
    <a class="nav-link active" href="<?php echo base_url('login') ?>">Login</a>
</li>
<li class="nav-item">
    <a class="nav-link" href="<?php echo base_url('cadastrar') ?>">Cadastrar</a>
</li>
</ul>
</div>
</div>
</nav>
<link href="css/tela.css" rel="stylesheet">
<div class="login-container"> <!-- Fiz uma tela de login personalizadaa -->
    <form action="" method="post">
        <div>
            <h1>Login</h1>
            <input type="text" placeholder="Login" name="login" required>
            <input type="password" placeholder="Senha" name="senha" required>
            <button>Acessar</button>
        </div>
        <div>
            <button onclick="window.location.href='<?php echo base_url('cadastrar') ?>'">Cadastre-se</button>
        </div>
    </form>
</div>

<?php
include('footer.php')
?>