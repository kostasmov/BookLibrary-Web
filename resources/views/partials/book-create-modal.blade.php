<div id="create-modal" class="modal">
    <div class="modal-content">
        <div class="form-row">
            <h2>Добавление книги</h2>
            <span id="create-close" class="close"><i class="fa-solid fa-xmark"></i></span>
        </div>

        <form class="form-container">
            <div class="form-row">
                <div class="form-group" style="width: 100%">
                    <label for="title">Название</label>
                    <input type="text" id="create-title" name="title">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
{{--                    <label for="firstName">Название</label>--}}
{{--                    <input type="text" id="create-title" name="title">--}}
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="publisher">Издатель</label>
                    <input type="text" id="create-publisher" name="publisher">
                </div>

                <div class="form-group">
                    <label for="type">Тип</label>
                    <input type="text" id="create-type" name="type">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="year">Год издания</label>
                    <input type="text" id="create-year" name="year">
                </div>

                <div class="form-group">
                    <label for="amount">Количество</label>
                    <input type="text" id="create-amount" name="amount">
                </div>
            </div>

            <div class="form-row button-row">
                <button class="safe-button" type="submit">Сохранить</button>
            </div>
        </form>
    </div>
</div>
