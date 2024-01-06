<div id="modal-sections-update" uk-modal>
    <div class="uk-modal-dialog">
        <button class="uk-modal-close-default" type="button" uk-close></button>
        <div class="uk-modal-header">
            <h5>ویرایش تراکنش</h5>
        </div>
        <div class="uk-modal-body">
            <form class="uk-grid-small update-transaction" uk-grid>

                <div class="uk-width-1-1@s">
                    <input class="uk-input t-price" name="price" type="text" value="" placeholder="قیمت">
                </div>

                <div class="uk-width-1-2@s">
                    <select class="uk-select t-plan-type" name="account_type" aria-label="Select">
                        <option value="1">طلایی</option>
                        <option value="2">نقره ای</option>
                        <option value="3">برنزی</option>
                    </select>
                </div>

                <div class="uk-width-1-2@s">
                    <input class="uk-input t-order-number" name="order_number" type="text" value="" placeholder="شماره سفارش">
                </div>

                <div class="uk-width-1-2@s">
                    <input class="uk-input t-refNumber" type="text" name="refNumber" value="" placeholder="شماره تراکنش" aria-label="100">
                </div>

                <div class="uk-width-1-2@s">
                    <select class="uk-select t-status" aria-label="Select" name="status">
                        <option value="0">ناموفق</option>
                        <option value="1">موفق</option>
                    </select>
                </div>
                <input type="hidden" class="t-id">
                <div class="uk-modal-footer uk-text-right">
                    <div class="uk-width-1-2@s">
                        <button type="submit" value="add-user" class="uk-button uk-button-primary">بروزرسانی</button>
                    </div>
                </div>
            </form>
        </div>

    </div>
</div>