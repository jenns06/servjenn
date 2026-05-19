<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login - ServJenn</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
    *{
        margin:0;
        padding:0;
        box-sizing:border-box;
        font-family:'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
    }

    html{
        width:100%;
        min-height:100%;
        overflow-x:hidden;
    }

    body{
        min-height:100vh;
        width:100%;
        display:flex;
        align-items:center;
        justify-content:center;
        padding:40px 16px;
        position:relative;
        overflow-x:hidden;

        background:
        linear-gradient(135deg,#6c7cff 0%,#3f3f8c 100%);
        
        background-size:cover;
        background-attachment:fixed;
    }

    /* BURBUJAS */
    body::before,
    body::after{
        content:"";
        position:absolute;
        width:300px;
        height:300px;
        border-radius:50%;
        background:rgba(255,255,255,0.08);
        z-index:-1;
        pointer-events:none;
        filter:blur(10px);
    }

    body::before{
        top:0;
        left:0;
        transform:translate(-35%,-35%);
    }

    body::after{
        bottom:0;
        right:0;
        transform:translate(35%,35%);
    }

    /* CARD */
    .card{
        width:100%;
        max-width:400px;

        padding:40px 30px;

        border-radius:24px;

        background:rgba(255,255,255,0.12);

        backdrop-filter:blur(20px);
        -webkit-backdrop-filter:blur(20px);

        border:1px solid rgba(255,255,255,0.2);

        box-shadow:0 25px 50px rgba(0,0,0,0.3);

        text-align:center;
        color:white;

        animation:fadeIn .8s ease-out;

        overflow:hidden;
    }

    @keyframes fadeIn{
        from{
            opacity:0;
            transform:translateY(20px);
        }

        to{
            opacity:1;
            transform:translateY(0);
        }
    }

    /* LOGO */
    .logo{
        width:100px;
        max-width:100%;
        height:auto;

        margin-bottom:15px;

        filter:drop-shadow(0 8px 12px rgba(0,0,0,0.3));

        transition:transform .3s ease;
    }

    .logo:hover{
        transform:scale(1.05) rotate(2deg);
    }

    h2{
        margin-bottom:8px;

        font-size:clamp(1.5rem,5vw,2rem);

        font-weight:700;

        letter-spacing:1px;
    }

    p{
        font-size:14px;
        opacity:.9;
        margin-bottom:25px;
        line-height:1.5;
    }

    /* INPUTS */
    .input-group{
        margin-bottom:15px;
        text-align:left;
    }

    input{
        width:100%;

        padding:14px 16px;

        border-radius:12px;

        border:1px solid rgba(255,255,255,0.2);

        background:rgba(255,255,255,0.1);

        color:white;

        outline:none;

        font-size:16px;

        transition:.3s;
    }

    input::placeholder{
        color:rgba(255,255,255,0.7);
    }

    input:focus{
        background:rgba(255,255,255,0.2);

        border-color:white;

        box-shadow:0 0 15px rgba(255,255,255,0.15);
    }

    /* ROLES */
    .roles{
        display:grid;

        grid-template-columns:repeat(auto-fit,minmax(100px,1fr));

        gap:10px;

        margin:20px 0;
    }

    .role-card{
        padding:14px 8px;

        border-radius:14px;

        background:rgba(255,255,255,0.15);

        border:1px solid rgba(255,255,255,0.1);

        color:white;

        font-size:13px;

        cursor:pointer;

        display:flex;
        flex-direction:column;
        align-items:center;
        justify-content:center;

        gap:6px;

        text-align:center;

        transition:all .3s ease;

        min-height:85px;
    }

    .role-card:hover{
        transform:translateY(-2px);

        background:rgba(255,255,255,0.25);
    }

    .role-card input{
        display:none;
    }

    .role-card:has(input:checked){
        background:white;
        color:#3f3f8c;

        font-weight:bold;

        box-shadow:0 8px 18px rgba(0,0,0,0.2);
    }

    /* BOTÓN */
    button{
        width:100%;

        padding:14px;

        margin-top:10px;

        border:none;

        border-radius:12px;

        background:white;

        color:#3f3f8c;

        font-size:16px;
        font-weight:800;

        text-transform:uppercase;

        letter-spacing:1px;

        cursor:pointer;

        transition:.3s;
    }

    button:hover{
        transform:translateY(-3px);

        background:#f8f9ff;

        box-shadow:0 12px 25px rgba(0,0,0,0.3);
    }

    /* ERRORES */
    .error-msg{
        background:rgba(255,82,82,0.2);

        border:1px solid #ff5252;

        padding:10px;

        border-radius:10px;

        font-size:13px;

        color:#ffdede;

        margin-bottom:15px;

        text-align:left;
    }

    .footer{
        margin-top:25px;

        font-size:12px;

        opacity:.7;

        line-height:1.5;
    }

    /* TABLETS */
    @media(max-width:768px){

        body{
            padding:30px 14px;
        }

        .card{
            max-width:450px;
        }
    }

    /* CELULARES */
    @media(max-width:480px){

        body{
            padding:20px 12px;
            align-items:center;
        }

        body::before,
        body::after{
            display:none;
        }

        .card{
            padding:30px 20px;

            border-radius:20px;
        }

        .logo{
            width:80px;
        }

        h2{
            font-size:1.5rem;
        }

        p{
            font-size:13px;
        }

        .roles{
            grid-template-columns:1fr 1fr;
            gap:8px;
        }

        .role-card{
            min-height:75px;
            font-size:12px;
            padding:10px 6px;
        }

        button{
            font-size:15px;
        }
    }

    /* CELULARES MUY PEQUEÑOS */
    @media(max-width:340px){

        .card{
            padding:25px 16px;
        }

        .roles{
            grid-template-columns:1fr;
        }

        .role-card{
            flex-direction:row;
            justify-content:center;

            min-height:auto;

            gap:10px;
        }

        input{
            padding:12px;
        }

        button{
            padding:12px;
        }
    }
</style>
<body>

<div class="card">
    <img src="{{ asset('img/logo.png') }}" class="logo" alt="Logo ServJenn">

    <h2>ServJenn</h2>
    <p>Sistema de Reparaciones Técnicas</p>

    @if ($errors->any())
        <div class="error-msg">
            <i class="fas fa-exclamation-circle"></i> Usuario o contraseña incorrectos
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="input-group">
            <input type="email" name="email" value="{{ old('email') }}" placeholder="Correo electrónico" required autofocus>
        </div>

        <div class="input-group">
            <input type="password" name="password" placeholder="Contraseña" required>
        </div>

        <div class="roles">
            <label class="role-card">
                <input type="radio" name="rol_ui" value="tecnico" checked>
                <span>👨‍🔧</span>
                Técnico
            </label>

            <label class="role-card">
                <input type="radio" name="rol_ui" value="admin">
                <span>👨‍💼</span>
                Admin
            </label>
        </div>

        <button type="submit">Entrar al Sistema</button>
    </form>

    <div class="footer">
        &copy; 2026 ServJenn | Calidad y Rapidez
    </div>
</div>

</body>
</html>