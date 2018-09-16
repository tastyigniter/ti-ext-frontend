<div class="container">
    <div class="row py-4">
        <div class="col-lg-6 col-md-8 col-sm-12 m-auto text-center">
            <div id="newsletter-box">
                <div class="newsletter-subscribe">
                    <h3 class="mb-4"><?= lang('igniter.frontend::default.newsletter.text_subscribe'); ?></h3>
                    <form
                        id="subscribeForm"
                        class="subscribe-form"
                        method="POST" data-request="<?= $subscribeHandler ?>">
                        <div class="input-group input-group-lg subscribe-group">
                            <input
                                type="text"
                                class="form-control"
                                name="subscribe_email"
                            >
                            <span class="input-group-addon">
                                <button
                                    id="subscribeButton"
                                    class="btn btn-info"
                                ><i class="fa fa-paper-plane-o"></i></button>
                            </span>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
