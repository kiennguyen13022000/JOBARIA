<?php
?>
<div class="average_rating">
    <span>Grae</span>
    <div class="flex-inline  pl-3 d-inline-block">
        <i class="fa fa-star" aria-hidden="true"></i>
        <i class="fa fa-star" aria-hidden="true"></i>
        <i class="fa fa-star" aria-hidden="true"></i>
        <i class="fa fa-star" aria-hidden="true"></i>
        <i class="fa fa-star" aria-hidden="true"></i>
    </div>
</div>
<div class="list_review">
    <div class="review_item mt-2">
        <strong class="">Jobarria</strong>
        <div class="">
            12/01/2015
        </div>
    </div>
    <div class="review_item mt-2">
        <strong class="">User</strong>
        <div class="">
            That's Ok
        </div>
    </div>
</div>

<button type="button" class="btn_black btn_write_review mt-3" data-toggle="modal"
        data-target="#review_modal">Write Your Reviews</button>

<div class="modal fade " id="review_modal" tabindex="-1" role="dialog"
     aria-labelledby="review_modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <form id="id_new_comment_form" class="mb-2" action="#">
                    <h2 class="title">Write your review</h2>
                    <div class="row mt-3">
                        <div class="product clearfix col-12 col-lg-6">
                            <img class="w-100" src="/jobaria/public/template/default/assets/images/product/medium-size/1-1.jpg"
                                 alt="">
                            <div class="product_desc mt-3">
                                <p class="product_name"><strong>HD Video Recording PJ Handycam
                                        Camcorder</strong></p>
                                <div class="limit_line_4">Create clearer, more shareable memories
                                    with Optical
                                    SteadyShot™
                                    image stabilization, share with Wi-Fi® or the built-in
                                    projector.
                                    Enjoy Full HD/60p resolution, a 26.8mm wide angle ZEISS® lens
                                    ...
                                </div>
                            </div>
                        </div>
                        <div class="new_comment_form_content col-12 col-lg-6 mt-4 mt-lg-0">
                            <p>Our FeedBack</p>
                            <!-- <div id="new_comment_form_error" class="error"
                              style="display:none;padding:15px 25px">
                              <ul></ul>
                            </div> -->
                            <div class="flex-inline  criterions_list my-2">
                                <i class="fa fa-star text-dark" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                            </div>
                            <div class="form-group">
                                <label for="comment">Your Review</label>
                                <textarea class="form-control" rows="5" id="comment"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="email">Name *</label>
                                <input type="text" class="form-control mt-3">
                            </div>
                            <div class="form-group">
                                <label for="email">Email *</label>
                                <input type="text" class="form-control mt-3">
                            </div>
                            <div class="mt-3 mb-4">

                                <span>* Required fields</span>
                            </div>
                            <div class="btn_box">
                                <button type="button" class="btn btn_black mr-3">Submit</button>
                                <button type="button" class="btn btn_black"
                                        data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>

                </form>
            </div>

        </div>
    </div>
</div>
