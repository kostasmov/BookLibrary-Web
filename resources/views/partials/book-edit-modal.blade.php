<div id="edit-modal" class="modal">
    <div class="modal-content">
        <div class="form-row">
            <h2>Добавление книги</h2>
            <span id="edit-close" class="close"><i class="fa-solid fa-xmark"></i></span>
        </div>

        <form class="form-container">
            <div class="form-row">
                <div class="form-group" style="width: 100%">
                    <label for="title">Название</label>
                    <input type="text" id="edit-title" name="title" placeholder="Название">
                </div>
            </div>

            <div class="authors-row">
                <label>Авторы</label>
                <div class="authors-input">
                    <input type="text" placeholder="Имя">
                    <input type="text" placeholder="Фамилия">
                    <button type="button" class="plus"><i class="fa-solid fa-plus"></i></button>
                </div>
                <div class="author-list">
                    <div class="author-name">
                        Томас Кормен <span class="remove">✖</span>
                    </div>
                    <div class="author-name">
                        Имя Автора 2 <span class="remove">✖</span>
                    </div>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="publisher">Издатель</label>
                    <input type="text" id="edit-publisher" name="publisher" placeholder="Издатель">
                </div>

                <div class="form-group">
                    <label for="type">Тип</label>

                    <select name="type" class="type-select">
                        <option value="fiction">Худ. литература</option>
                        <option value="technic">Техн. литература</option>
                    </select>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="year">Год издания</label>
                    <input type="text" id="edit-year" name="year">
                </div>

                <div class="form-group">
                    <label for="amount">Количество</label>
                    <div class="amount-wrapper">
                        <button type="button" class="amount-btn" id="decrease">&#8722;</button>
                        <input type="text" id="amount" value="4" readonly>
                        <button type="button" class="amount-btn" id="increase">&#43;</button>
                    </div>
                </div>
            </div>

            <div class="form-row button-row">
                <button class="safe-button" type="submit">Сохранить</button>
            </div>
        </form>
    </div>
</div>
