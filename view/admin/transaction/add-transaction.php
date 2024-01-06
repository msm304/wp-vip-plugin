<div id="modal-sections-add" uk-modal>
    <div class="uk-modal-dialog">
        <button class="uk-modal-close-default" type="button" uk-close></button>
        <div class="uk-modal-header">
            <h5>افزودن تراکنش</h5>
        </div>
        <div class="uk-modal-body">
            <div class="show-message uk-alert uk-alert-primary"></div>
            <form class="uk-grid-small add-transaction" uk-grid>

                <div class="uk-width-1-2@s">
                    <select class="uk-select plan-type" aria-label="Select">
                        <option value="1">طلایی</option>
                        <option value="2">نقره ای</option>
                        <option value="3">برنزی</option>
                    </select>
                </div>

                <div class="uk-width-1-2@s">
                    <input class="uk-input first-name" type="text" value="" placeholder="نام">
                </div>

                <div class="uk-width-1-2@s">
                    <input class="uk-input last-name" type="text" value="" placeholder="نام خانوادگی">
                </div>

                <div class="uk-width-1-2@s">
                    <input class="uk-input email" type="text" value="" placeholder="ایمیل">
                </div>

                <div class="uk-width-1-2@s">
                    <input class="uk-input order-number" type="text" value="" placeholder="شماره سفارش">
                </div>

                <div class="uk-width-1-2@s">
                    <input class="uk-input refNumber" type="text" value="" placeholder="شماره تراکنش" aria-label="100">
                </div>

                <div class="uk-width-1-2@s">
                    <input class="uk-input price" type="text" value="" placeholder="قیمت">
                </div>

                <div class="uk-width-1-2@s">
                    <select class="uk-select status" aria-label="Select">
                        <option value="0">ناموفق</option>
                        <option value="1">موفق</option>
                    </select>
                </div>
                <input type="hidden" class="id">
                <div class="uk-modal-footer uk-text-right">
                    <div class="uk-width-1-2@s">
                        <button type="submit" value="add-user" class="uk-button uk-button-primary">افزودن</button>
                    </div>
                </div>
            </form>
        </div>

    </div>
</div>