<div id="inplayer-3" class="postbox">
    <h2 class="hndle"><span><?php esc_attr_e('Available Balance', INPLAYER_TEXT_DOMAIN); ?></span></h2>
    <table class="wp-list-table widefat stripped">
        <thead></thead>
        <tbody>
        <?php $balances = $transactions->get_current_balance();
        if (empty($balances)):
            echo '<tr><td>' . __('No Purchases', INPLAYER_TEXT_DOMAIN) . '</td></tr>';
        else:
            foreach ($balances as $currency_iso => $current_balance):
                $current_balance = number_format($current_balance, 2, '.', '');
                ?>
                <tr>
                    <td><?php echo $currency_iso; ?></td>
                    <td><?php echo $current_balance; ?></td>
                    <td style="text-align:right;">
                        <form method="post">
                            <input type="hidden" name="action" value="inplayer_platform_payout">
                            <input type="number" name="amount" required min="1.00"
                                   data-max="<?php echo $current_balance; ?>" onchange="validateNum(this);"
                                   max="<?php echo $current_balance; ?>" step="0.5" placeholder="0.00">
                            <span class="spinner inplayer-spinner"></span>
                            <input type="submit" id="<?php echo $currency_iso; ?>" data-currency="<?php echo $currency_iso; ?>"
                                   data-amount="<?php echo $current_balance; ?>" class="platform-payout button button-primary"
                                   data-gateway="PayPal"
                                   value="<?php esc_attr_e('Withdraw', INPLAYER_TEXT_DOMAIN); ?>">
                        </form>
                    </td>
                </tr>
                <?php
            endforeach;
        endif;
        unset($balances, $currency_iso, $current_balance);
        ?>
        </tbody>
    </table>
</div>

<script type="text/javascript">
    function validateNum(input) {
        if (parseFloat(input.value) > parseFloat(jQuery(input).data('max'))) {
            input.value = jQuery(input).data('max');
        }
    }
</script>