<div class="poll_user_form">
    <div class="header">Fill your detail here</div>
    <div class="content">
        <form class="mobilepopup-form" action="<?=SITE_URL?>/front/pollsubmit">
            <div class="form-group col-md-12 padding-left-o">
                <div class="input text">
                    <label>Full Name *</label>
                    <input type="text" name="poll_user_name" id="poll_user_name" class="form-control" />
                </div>
                <div class="input text">
                    <label>Mobile *</label>
                    <input type="text" name="poll_user_mobile" id="poll_user_mobile" class="form-control" />
                </div>
                <div class="input text">
                    <label>City/Village</label>
                    <input type="text" name="poll_user_city" id="poll_user_city" class="form-control" value="" />
                </div>
                <div class="input text">
                    <label>District</label>
                    <input type="text" name="poll_user_district" id="poll_user_district" class="form-control" />
                </div>
                <div class="input text">
                    <label>State</label>
                    <input type="text" name="poll_user_state" id="poll_user_state" class="form-control" />
                </div>
                <input type="hidden" name="poll_id" id="poll_id" class="form-control" value="<?=$poll_id?>" />
                <input type="hidden" name="poll_answer" id="poll_answer" class="form-control" value="<?=$selected_ans?>" />
            </div>
        </form>
    </div>
    <div class="footer">
        <!--<a href="" class="button get-demopopup2">Open demo 2</a>-->
        <button id="submit_vote_detail" type="button" class="button" onclick="voteAction();" >Submit</button>
        <a href="" class="submit-mobilepopup-form button">Send</a>
    </div>
</div>