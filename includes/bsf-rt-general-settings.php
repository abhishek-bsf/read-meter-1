<?php
$options = get_option('bsf_rt_general_settings');

$bsf_rt_words_per_minute = '';

$bsf_rt_post_types = array();

$bsf_rt_include_images = '';

$bsf_rt_include_comments = '';

if (isset($options['bsf_rt_words_per_minute'])) {

  $bsf_rt_words_per_minute = $options['bsf_rt_words_per_minute'];
}

if (isset($options['bsf_rt_post_types'])) {

  $bsf_rt_post_types = $options['bsf_rt_post_types'];
}

if (isset($options['bsf_rt_include_images'])) {

  $bsf_rt_include_images = $options['bsf_rt_include_images'];
}

if (isset($options['bsf_rt_include_comments'])) {

  $bsf_rt_include_comments = $options['bsf_rt_include_comments'];
}

$args = array(
            'public'   => true,
            
            );
           
$exclude=array('attachment','elementor_library','Media','My Templates');
?>
<div class="bsf_rt_global_settings" id="bsf_rt_global_settings">
  <form action="" method="post" name="bsf_rt_settings_form">
    <table class="form-table" > 
        <tr>
          
          <h3> General Settings </h3>
        </tr>
          <p class="description">

              Control the core settings of a read meter, e.g. the average count of words that humans can read in a minute & allow a read meter on particular post types, etc.
          </p>  
        
        <tr>
          <th scope="row">
            <label for="WordsPerMinute">Words Per Minute :</label>
          </th>
          <td>
            <input type="number" required name="bsf_rt_words_per_minute" placeholder="275" value="<?php  echo $bsf_rt_words_per_minute; ?>" class="small-text">
          </td>
        </tr>

        <tr>
            <th scope="row">
              <label for="SelectPostTypes">Select Post Types :</label>
            </th>
            <td class="post_type_name">
                  
                  <?php
                
                foreach ( get_post_types($args, 'objects') as $post_type ) {

                      if (in_array($post_type->labels->name, $exclude)  ) {

                          continue;
                      } 
                      if ($bsf_rt_post_types !== 'post') {
                        if (isset($bsf_rt_post_types)) {
                          if (in_array($post_type->name, $bsf_rt_post_types)) {
                             echo'<label for="ForPostType">
                             <input type="checkbox" checked name="posts[]" value="'.$post_type->name.'">
                             '.$post_type->labels->name.'</label><br> ';
                              } else {
                                  echo'<label for="ForPostType">
                             <input type="checkbox"  name="posts[]" value="'.$post_type->name.'">
                             '.$post_type->labels->name.'</label><br> ';
                              }
                          } else {
                              echo'<label for="ForPostType">
                             <input type="checkbox"  name="posts[]" value="'.$post_type->name.'">
                             '.$post_type->labels->name.'</label><br> ';
                          }
                      } else {
                      if ($post_type->name == 'post') {
                        echo'<label for="ForPostType">
                         <input type="checkbox" checked name="posts[]" value="'.$post_type->name.'">
                         '.$post_type->labels->name.'</label><br> ';
                      }
                       echo'<label for="ForPostType">
                         <input type="checkbox"  name="posts[]" value="'.$post_type->name.'">
                         '.$post_type->labels->name.'</label><br> ';
                          }
                }
                   ?>
           </td>
        </tr>
        <tr>
          <th scope="row">

            <label for="IncludeComments">Include Comments :</label>
          </th>
          <td>
              <?php if (isset($bsf_rt_include_comments) && $bsf_rt_include_comments == 'yes') {
                 echo '<input type="checkbox" checked name="bsf_rt_include_comments" value="yes">';
              } else {
                echo '<input type="checkbox" name="bsf_rt_include_comments" value="yes">';
              }
             ?>
              <p class="description">

                 Check if you want to count the comments in the Reading time.
              </p>  
          </td>
        </tr>
        <tr>
          <th scope="row">

             <label for="IncludeImages">Include Images :</label>
          </th>
          <td>
            <?php if (isset($bsf_rt_include_images) && $bsf_rt_include_images == 'yes') {

               echo '<input type="checkbox" checked name="bsf_rt_include_images" value="yes">';
            } else {

              echo '<input type="checkbox" name="bsf_rt_include_images" value="yes">';
            }
           ?>
            <p class="description">   

               Check if you want to count the Images in the Reading time.
            </p>  
          </td>
        </tr>
    </table>
    <table class="form-table">
       <tr>
          <th>

            <input type="submit" value="Save" class="bt button button-primary" name="submit">
          </th>
       </tr>
    </table>
  </form>
</div>

<?php
if (isset($_POST['submit'])) {

    $bsf_rt_words_per_minute=$_POST['bsf_rt_words_per_minute'];
     if (isset($_POST['bsf_rt_words_per_minute'])) {

      $bsf_rt_words_per_minute=$_POST['bsf_rt_words_per_minute'];

    } else {

      $bsf_rt_words_per_minute = '';
    }
    
    if (isset($_POST['posts'])) {

     $bsf_rt_post_types=$_POST['posts'];

    } else {

      $bsf_rt_post_types = array();
    }
    if (isset($_POST['bsf_rt_include_images'])) {

      $bsf_rt_include_images=$_POST['bsf_rt_include_images'];

    } else {

      $bsf_rt_include_images = '';
    }
    if (isset($_POST['bsf_rt_include_comments'])) {

      $bsf_rt_include_comments=$_POST['bsf_rt_include_comments'];
    } else {

      $bsf_rt_include_comments = '';
    }

    $update_options = array(
      'bsf_rt_words_per_minute'   => $bsf_rt_words_per_minute,
      'bsf_rt_post_types'     => $bsf_rt_post_types,
      'bsf_rt_include_comments' => $bsf_rt_include_comments,
      'bsf_rt_include_images' => $bsf_rt_include_images,

    );
    update_option('bsf_rt_general_settings', $update_options);
    echo '<meta http-equiv="refresh" content="0.1" />';
}
