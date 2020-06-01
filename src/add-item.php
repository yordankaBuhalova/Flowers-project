<?php
    include 'includes/header.inc';
?>
<div class="container contb">
    <h4>Добави Артикул</h4>
    <br>
    <div class="media">

        <div class="media-body col-6">

            <form>
                <div class="form-group">
                    <label for="name">Име</label>
                    <input type="text" class="form-control"  >

                </div>
                <div class="form-group">
                    <label for="price">Цена в лв:</label>
                    <input  class="form-control" id="exampleInputPassword1">
                </div>
                <div class="form-group">
                    <label for="type">Тип</label>
                    <select class="form-control" id="type">
                        <option>Букети</option>
                        <option>Арт букети</option>
                        <option>Стайни растения</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="description">Описание</label>
                    <textarea type="text" class="form-control" rows="5" id="description"></textarea>
                </div>
                <button type="button" class="btn btn-primary">Откажи се</button>
                <button type="button" class="btn btn-primary">Запази</button>

            </form>

        </div>
    </div>
</div>
<?php
    include 'includes/footer.inc';
?>