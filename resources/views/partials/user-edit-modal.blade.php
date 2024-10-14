<div id="edit-modal" class="modal">
    <div class="modal-content">
        <div class="form-row">
            <h2>Редактирование пользователя</h2>
            <span id="edit-close" class="close"><i class="fa-solid fa-xmark"></i></span>
        </div>

        <form class="form-container">
            <div class="form-row">
                <div class="form-group">
                    <label for="firstName">Имя</label>
                    <input type="text" id="edit-firstName" name="firstName">
                </div>

                <div class="form-group">
                    <label for="lastName">Фамилия</label>
                    <input type="text" id="edit-lastName" name="lastName">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="login">Логин</label>
                    <input type="text" id="edit-login" name="login">
                </div>

                <div class="form-group">
                    <label for="group">Группа</label>
                    <input type="text" id="edit-group" name="group">
                </div>
            </div>

            <div class="form-row button-row">
                <button class="safe-button" type="submit">Сохранить</button>
            </div>
        </form>
    </div>
</div>
