<p align="center">
    <pre align="center" style="font-size: 14px">
██████╗ ███████╗████████╗ ██████╗ █████╗ ██████╗ ███████╗
██╔══██╗██╔════╝╚══██╔══╝██╔════╝██╔══██╗██╔══██╗██╔════╝
██████╔╝█████╗     ██║   ██║     ███████║██████╔╝█████╗  
██╔══   ██╔══╝     ██║   ██║     ██╔══██║██╔══██╗██╔══╝  
██║     ███████╗   ██║   ╚██████╗██║  ██║██║  ██║███████╗
╚═╝     ╚══════╝   ╚═╝    ╚═════╝╚═╝  ╚═╝╚═╝  ╚═╝╚══════╝
    </pre>
    <h2 align="center">🐶💛 PetCare – Seu painel de amor, cuidado e saúde para pets</h2>
    <p align="center">Um sistema simples, fofo e funcional para acompanhar vacinas, consultas e cuidados essenciais dos seus animais de estimação.</p>
</p>

---

## 🐾 Sobre o Projeto

O *PetCare* é uma aplicação web criada em *Laravel 12* com banco *PostgreSQL*, pensada para quem quer manter o acompanhamento de saúde dos seus pets organizado, acessível e visualmente acolhedor.

Ele funciona como uma *agenda amorosa de cuidados*, permitindo:

- Cadastrar seus pets  
- Registrar vacinas  
- Anotar consultas veterinárias  
- Ver alertas de vacinas atrasadas  
- Acompanhar tudo em um dashboard intuitivo  

💛 *Feito com carinho — porque cada pet merece cuidados, atenção e um cantinho especial.*

---

## ✨ Funcionalidades

- 🐕 *Cadastro de pets* (nome, espécie, idade, peso, foto)  
- 💉 *Controle de vacinas* (data aplicada e próxima dose)  
- 🩺 *Registro de consultas veterinárias*  
- 🔔 *Alertas automáticos de vacinas atrasadas*  
- 📊 *Dashboard com informações importantes*  
- 🐈 *Relação de pets por usuário* (cada tutor vê apenas seus animais)  

---

## 🛠 Tecnologias Utilizadas

- *Laravel 12*  
- *PostgreSQL*  
- *Blade Templates*  
- *Chart.js*  
  

---

## 🗂 Estrutura do Banco de Dados

As tabelas principais do sistema são:

- *users* (padrão Laravel)  
- *pets*  
- *vacinas*  
- *consultas*

Cada pet pertence a um usuário e possui registros de vacinas e consultas.

---

## ▶ Como Executar o Projeto

bash
# Clonar o repositório
git clone https://github.com/SEU-USUARIO/PetCare.git

# Acessar a pasta
cd PetCare

# Instalar dependências
composer install

# Configurar o .env
cp .env.example .env

# Gerar chave da aplicação
php artisan key:generate

# Criar tabelas
php artisan migrate

# Iniciar o servidor
php artisan serve


Acesse:  
🔗 *http://127.0.0.1:8000*

---


## 🗓 Futuras Melhorias

- Upload de carteira de vacinação  
- Área para lembretes de banho/tosa  
- Suporte para múltiplos usuários por pet (casais/aplicação compartilhada)  
- Modo escuro  
- Filtros e estatísticas avançadas  

---

## 📄 Licença
MIT License – livre para usar, melhorar e compartilhar.

