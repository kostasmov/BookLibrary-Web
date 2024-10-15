<div id="modal" class="modal">
    <div class="modal-content">
        <div class="form-row">
            <h2 id="modal-name"></h2>
            <button id="close" class="round-button close" type="button"><i class="fa-solid fa-xmark"></i></button>
        </div>

        <form class="form-container">
            <div class="form-inputs">
                <div class="form-group" style="width: 100%">
                    <label for="title">Название</label>
                    <input type="text" id="title" name="title">
                </div>

                <div class="authors-row">
                    <label>Авторы</label>
                    <div class="authors-input">
                        <input type="text" placeholder="Имя">
                        <input type="text" placeholder="Фамилия">
                        <button type="button" id="add-author-button" class="round-button green"><i class="fa-solid fa-plus"></i></button>
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

                <div class="form-group">
                    <label for="publisher">Издатель</label>
                    <input type="text" id="publisher" name="publisher">
                </div>

                <div class="form-group">
                    <label for="type">Тип</label>
                    <select id="type" name="type" class="type-select">
                        <option value="fiction">Худ. литература</option>
                        <option value="technic">Техн. литература</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="year">Год издания</label>
                    <select id="year" name="year">
                        @for ($year = date('Y'); $year >= 1950; $year--)
                            <option value="{{ $year }}">{{ $year }}</option>
                        @endfor
                    </select>
                </div>

                <div class="form-group">
                    <label for="amount">Количество</label>
                    <div class="amount-wrapper">
                        <button type="button" class="round-button grey" id="decrease"><i class="fa-solid fa-minus"></i></button>
                        <input type="text" id="amount" value="1" readonly>
                        <button type="button" class="round-button green" id="increase"><i class="fa-solid fa-plus"></i></button>
                    </div>
                </div>
            </div>

            <div class="button-row">
                <button id="delete-button" class="grey" type="button">Удалить</button>
                <button id="save-button" class="yellow" type="button">Сохранить</button>
            </div>
        </form>
    </div>
</div>
