<div id="newsletter-box" class="<?= $subscribeCssClass ?>">
    <div class="newsletter-subscribe">
        <h3><?= lang('text_subscribe'); ?></h3>
        <form
            id="subscribeForm"
            class="subscribe-form"
            method="POST" data-request="<?= $subscribeHandler ?>">
            <div class="input-group subscribe-group">
                <input
                    type="text"
                    class="form-control"
                    name="subscribe_email"
                >
                <span class="input-group-addon">
                    <button
                        id="subscribeButton"
                        class="btn btn-default"
                    ><i class="fa fa-paper-plane-o"></i></button>
                </span>
            </div>
        </form>
    </div>
</div>
<div class="clearfix"></div>
<script type="text/javascript"><!--
    //    function subscribeEmail() {
    //        var subscribe_email = $('input[name=\'subscribe_email\']').val()
    //
    //        $.ajax({
    //            url: js_site_url('newsletter/newsletter/subscribe'),
    //            type: 'POST',
    //            data: 'subscribe_email=' + subscribe_email,
    //            dataType: 'json',
    //            success: function (json) {
    //                var alert_close = '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'
    //                var newsletter_alert = $('#newsletter-alert .newsletter-alert')
    //                var alert_message = ''
    //
    //                if (json['redirect']) {
    //                    window.location.href = json['redirect']
    //                }
    //
    //                if (json['error']) {
    //                    alert_message = '<div class="alert alert-danger">' + alert_close + json['error'] + '</div>'
    //                }
    //
    //                if (json['success']) {
    //                    alert_message = '<div class="alert alert-success">' + alert_close + json['success'] + '</div>'
    //                    $('input[name=\'subscribe_email\']').val('')
    //                }
    //
    //                newsletter_alert.empty()
    //                newsletter_alert.append(alert_message)
    //                $('#newsletter-alert').fadeIn('slow').fadeTo('fast', 0.5).fadeTo('fast', 1.0)
    //            }
    //        })
    //    }
    //--></script>
