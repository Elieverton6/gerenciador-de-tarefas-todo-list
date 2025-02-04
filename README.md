# Gerenciador de Tarefas Laravel

Este é um **Sistema de Gerenciamento de Tarefas** desenvolvido com o framework **Laravel** (PHP). Ele oferece funcionalidades essenciais como criação, finalização, reversão da finalização e exclusão de tarefas, além de integração com **Cache** para otimização de desempenho.

## Funcionalidades Principais
- **Criação de Tarefas**: Adicione novas tarefas com validação de dados.
- **Finalização de Tarefas**: Marque as tarefas como concluídas e reverta essa ação quando necessário.
- **Exclusão de Tarefas**: Exclua tarefas com confirmação para evitar exclusões acidentais.
- **Armazenamento em Cache**: Otimiza o desempenho ao reduzir as consultas ao banco de dados.
- **Alertas Visuais**: Utiliza o **SweetAlert2** para feedbacks de sucesso ou erro, garantindo uma experiência de usuário clara e interativa.

## Tecnologias Utilizadas
- **Laravel** (PHP)
- **SweetAlert2** para alertas interativos
- **Cache** para otimização de performance

## Objetivo
O objetivo deste projeto é proporcionar uma maneira simples e eficiente de gerenciar tarefas do dia a dia. O sistema permite criar tarefas, marcar como concluídas, reverter tarefas finalizadas e excluir tarefas de forma rápida, com feedbacks visuais claros para o usuário.

## Como Usar

1. **Clone o Repositório**:
    ```bash
    git clone https://github.com/egzinn/gerenciador-de-tarefas.git
    ```
   
2. **Instale as Dependências**:
    Navegue até o diretório do projeto e execute:
    ```bash
    composer install
    ```

3. **Configure o `.env`**:
    Crie um arquivo `.env` na raiz do projeto com as configurações necessárias, como a conexão com o banco de dados.

4. **Execute as Migrações**:
    Para configurar o banco de dados, execute as migrações:
    ```bash
    php artisan migrate
    ```

5. **Inicie o Servidor Local**:
    Para rodar o servidor localmente, use:
    ```bash
    php artisan serve
    ```

6. **Acesse o Sistema**:
    O sistema estará disponível em `http://127.0.0.1:8000` após iniciar o servidor.

## Contribuições

Sinta-se à vontade para contribuir com o projeto! Para sugerir melhorias ou corrigir problemas, basta criar um **Issue** ou enviar um **Pull Request**.

---

### **Link do Projeto**  
[GitHub - Gerenciador de Tarefas Laravel](https://github.com/egzinn/gerenciador-de-tarefas)
