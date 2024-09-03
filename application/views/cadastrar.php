<?php 
    include('header.php');
?>

<li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url('login') ?>">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="<?php echo base_url('cadastrar') ?>">Cadastrar</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
<div class="login-container">
        <h1>Cadastrar</h1>
        <form action="" method="post">
            <input type="text" name="login" placeholder="Login" required>
            <input type="password" name="senha" placeholder="Senha" required>
            <input type="password" name="senha2" placeholder="Confirme a senha" required>
            <button type="submit" class="btn btn-primary">Cadastrar</button>
        </form>
    </div>

    <?php 
    include('footer.php');
?>