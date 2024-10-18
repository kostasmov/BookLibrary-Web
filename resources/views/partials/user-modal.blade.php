<div id="modal" class="modal">
    <div class="modal-content">
        <div class="form-row">
            <h2 id="modal-name"></h2>
            <button type="button" id="close" class="round-button close"><i class="fa-solid fa-xmark"></i></button>
        </div>

        <form class="form-container">
            <div class="form-inputs">
                <div class="form-group">
                    <label for="firstName">Имя</label>
                    <input type="text" id="firstName" name="firstName" maxlength="30">
                </div>

                <div class="form-group">
                    <label for="lastName">Фамилия</label>
                    <input type="text" id="lastName" name="lastName" maxlength="30">
                </div>

                <div class="form-group">
                    <label for="login">Логин</label>
                    <input type="text" id="login" name="login" maxlength="20">
                </div>

                <div class="form-group" id="password-group">
                    <label for="password">Пароль</label>
                    <input type="text" id="password" name="password" maxlength="30">
                </div>

                <div class="form-group">
                    <label for="group">Группа</label>
                    <input type="text" id="group" name="group" placeholder="И/б-20-1-о">
                </div>
            </div>

            <div class="button-row">
                <button id="delete-button" class="grey" type="button">Удалить</button>
                <button id="save-button" class="yellow" type="button">Сохранить</button>
            </div>
        </form>
    </div>
</div>
