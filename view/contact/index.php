{% extends 'frontend/template.php' %}

{% block content %}
<div class="container">
<div class="row">
    <div class="col-md-6 col-md-offset-3">
        <h2>Contact Us</h2> Got a question ? Feedback? Awesome!
        <p>
            Send your message in the form below and we will get back to you as early as possible.
        </p>
        <form role="form" method="post" id="reused_form"   >
            <div class="form-group">
                <label for="name">
                    Nom:</label>
                <input type="text" class="form-control"
                id="name" name="name"  required maxlength="50">

            </div>
            <div class="form-group">
                <label for="email">
                    Email:</label>
                <input type="email" class="form-control"
                id="email" name="email" required maxlength="50">
            </div>
			<div class="form-group">
                <label for="subject">
                    Sujet:</label>
                <input type="subject" class="form-control"
                id="subject" name="subject" required maxlength="80">
            </div>
            <div class="form-group">
                <label for="name">
                    Message:</label>
                <textarea class="form-control" type="textarea" name="message"
                id="message" placeholder="Your Message Here"
                maxlength="6000" rows="7"></textarea>
            </div>
            <div class="row" style="margin-bottom:30px;">
                  <div class="col-sm-5">
                  <!-- Notre boite de vérification pour un serveur localhost
					Site key: 6LeIxAcTAAAAAJcZVRqyHh71UMIEGNQ_MXjiZKhI
					Secret key: 6LeIxAcTAAAAAGG-vFI1TnRWxMZNFuojJ4WifJWe
				  
				  -->
						  <div class="g-recaptcha" 
						  data-sitekey="6LeIxAcTAAAAAJcZVRqyHh71UMIEGNQ_MXjiZKhI">
						  </div>
					</div>
			</div>


            <button type="submit" class="btn btn-lg btn-success pull-right" id="btnContactUs">Post It! →</button>

        </form>
        <div id="success_message" style="width:100%; height:100%; display:none; ">
            <h3>Sent your message successfully!</h3>
        </div>
        <div id="error_message"
        style="width:100%; height:100%; display:none; ">
            <h3>Erreur</h3>
            <p>Il y a eu une erreur lors de l'envoie du message.</p>

        </div>
    </div>
</div>
</div>
{% endblock %}