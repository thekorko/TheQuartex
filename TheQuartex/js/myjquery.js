//ver 0.2
jQuery(document).ready(function($) {
    //console.log("test 1");       //wrapper
    $(".karmavote").click(function() {
     //event
        let this2 = this;           //use in callback
        let action_and_post = this.value;
        let action_post = action_and_post.split('-');
        let my_action = action_post[0];
        let post_id = action_post[1];
        console.log("test 1")
        if (!my_action=="up" || !my_action=="down") {
          console.log("Invalid request");
        } else {
          $.post(my_ajax_obj.ajax_url, {     //POST request
              _ajax_nonce: my_ajax_obj.nonce, //nonce
              type: "POST",
              action: "karma_handler",        //action
              post_id: post_id,             //data
              my_action: my_action,
          }, function(data) {
            if (data!="False") {
              let elemento = `post-karma-${post_id}`;
              //console.log(elemento);
              let post_karma = document.getElementById(elemento);
              //post_karma.innerHTML.remove();    //remove the current title
              post_karma.innerHTML = data;         //insert server response
            } else {
              console.log("Invalid request");
            }
          });
        }
    });
});
