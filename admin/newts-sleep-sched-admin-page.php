<div class="wrap">

<div id="newts-sleep-sched-page">

    <form method="post" action="<?php echo esc_html( admin_url( 'admin-post.php' ) ); ?>">
    <input type="hidden" name="action" value="nss_hours_hook">

    <h1>Cat Cafe Hours</h1>
    <h5>This page controls the hours shown in the footer <br>
    as well as the times/days available for reservation.</h5>


    <fieldset class="nss-fieldset">
    <legend>
        <div id="newtynewt"></div>
    </legend>

    <table>
        <tr>
            <th></th>
            <th>open</th>
            <th>close</th>
            <th>adult-only?</th>
        </tr>


      <?php

        foreach ( $newts_days as $idx => $day ) {
            $time_val0 = $newts_sched_arr['nss_' . $day . '_' . $idx ][0]
                ? esc_attr( $newts_sched_arr['nss_' . $day . '_' . $idx ][0] )
                : null;
            $time_val1 = isset( $newts_sched_arr['nss_' . $day . '_' . $idx ][1] )
                ? esc_attr( $newts_sched_arr['nss_' . $day . '_' . $idx ][1] )
                : null;
            $adult_only = $newts_sched_ad_arr['nss_' . $day . '_' . $idx] && $newts_sched_ad_arr['nss_' . $day . '_' . $idx][0]
                ? 1
                : null;
            $time_val2 = isset( $newts_sched_ad_arr['nss_' . $day . '_' . $idx ][1] )
                ? esc_attr( $newts_sched_ad_arr['nss_' . $day . '_' . $idx][1] )
                : null;
            $time_val3 = isset( $newts_sched_ad_arr['nss_' . $day . '_' . $idx ][2] )
                ? esc_attr( $newts_sched_ad_arr['nss_' . $day . '_' . $idx][2] )
                : null;
            $adult_row = $adult_only
                ? '<tr class="adult-row">
                    <td></td>
                    <td><input type="time" name="' . $day . '_' . $idx . '_2" value="' . $time_val2 . '" /></td>
                    <td><input type="time" name="' . $day . '_' . $idx . '_3" value="' . $time_val3 . '" /></td>
                    <td></td>
                   </tr>'
                : '';

          echo(
            '<tr><td>' . $day . ':</td>
                <td><input type="time" name="' . $day . '_' . $idx . '_0" value="' .
                $time_val0 . '" /></td>
                <td><input type="time" name="' . $day . '_' . $idx . '_1" value="' .
                $time_val1 . '" /></td>
                <td><input type="checkbox" name="' . $day . '_' . $idx . '_ad" value="1"' .
                    checked( $adult_only, 1, false ) .'/></td>
            </tr>' . $adult_row);
        }
      ?>

    </table>

    </fieldset>

    <br>

      <?php
          wp_nonce_field( 'nss_hours_save', 'nss_hours_nonce' );
          submit_button();
      ?>

  </form>

</div>

</div>

