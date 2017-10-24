<?php
/**
 * @file
 * Default theme implementation to display a node.
 *
 * Available variables:
 * - $title: the (sanitized) title of the node.
 * - $content: An array of node items. Use render($content) to print them all,
 *   or print a subset such as render($content['field_example']). Use
 *   hide($content['field_example']) to temporarily suppress the printing of a
 *   given element.
 * - $user_picture: The node author's picture from user-picture.tpl.php.
 * - $date: Formatted creation date. Preprocess functions can reformat it by
 *   calling format_date() with the desired parameters on the $created variable.
 * - $name: Themed username of node author output from theme_username().
 * - $node_url: Direct URL of the current node.
 * - $display_submitted: Whether submission information should be displayed.
 * - $submitted: Submission information created from $name and $date during
 *   template_preprocess_node().
 * - $classes: String of classes that can be used to style contextually through
 *   CSS. It can be manipulated through the variable $classes_array from
 *   preprocess functions. The default values can be one or more of the
 *   following:
 *   - node: The current template type; for example, "theming hook".
 *   - node-[type]: The current node type. For example, if the node is a
 *     "Blog entry" it would result in "node-blog". Note that the machine
 *     name will often be in a short form of the human readable label.
 *   - node-teaser: Nodes in teaser form.
 *   - node-preview: Nodes in preview mode.
 *   The following are controlled through the node publishing options.
 *   - node-promoted: Nodes promoted to the front page.
 *   - node-sticky: Nodes ordered above other non-sticky nodes in teaser
 *     listings.
 *   - node-unpublished: Unpublished nodes visible only to administrators.
 * - $title_prefix (array): An array containing additional output populated by
 *   modules, intended to be displayed in front of the main title tag that
 *   appears in the template.
 * - $title_suffix (array): An array containing additional output populated by
 *   modules, intended to be displayed after the main title tag that appears in
 *   the template.
 *
 * Other variables:
 * - $node: Full node object. Contains data that may not be safe.
 * - $type: Node type; for example, story, page, blog, etc.
 * - $comment_count: Number of comments attached to the node.
 * - $uid: User ID of the node author.
 * - $created: Time the node was published formatted in Unix timestamp.
 * - $classes_array: Array of html class attribute values. It is flattened
 *   into a string within the variable $classes.
 * - $zebra: Outputs either "even" or "odd". Useful for zebra striping in
 *   teaser listings.
 * - $id: Position of the node. Increments each time it's output.
 *
 * Node status variables:
 * - $view_mode: View mode; for example, "full", "teaser".
 * - $teaser: Flag for the teaser state (shortcut for $view_mode == 'teaser').
 * - $page: Flag for the full page state.
 * - $promote: Flag for front page promotion state.
 * - $sticky: Flags for sticky post setting.
 * - $status: Flag for published status.
 * - $comment: State of comment settings for the node.
 * - $readmore: Flags true if the teaser content of the node cannot hold the
 *   main body content.
 * - $is_front: Flags true when presented in the front page.
 * - $logged_in: Flags true when the current user is a logged-in member.
 * - $is_admin: Flags true when the current user is an administrator.
 *
 * Field variables: for each field instance attached to the node a corresponding
 * variable is defined; for example, $node->body becomes $body. When needing to
 * access a field's raw values, developers/themers are strongly encouraged to
 * use these variables. Otherwise they will have to explicitly specify the
 * desired field language; for example, $node->body['en'], thus overriding any
 * language negotiation rule that was previously applied.
 *
 * @see template_preprocess()
 * @see template_preprocess_node()
 * @see template_process()
 *
 * @ingroup themeable
 */
?>
<div class="arrangementer_front_block" style="width: 100%;"></div>
<div class="container-fluid">
    <div class="row well">

        <div class="col-lg-5 col-md-6 col-sm-6 col-xs-12 col-xs-height col-full-height">

            <div id="node-<?php print $node->nid; ?>" class="<?php print $classes; ?> clearfix"<?php print $attributes; ?>>

                <?php print $user_picture; ?>

                <h2><?php print $title ?></h2>

                <?php if (!$page): ?>
                  <h2<?php print $title_attributes; ?>><a href="<?php print $node_url; ?>"><?php print $title; ?></a></h2>
                <?php endif; ?>

                <div class="lead">
                    <span class="btn btn-info">
                        <?php print render($content['field_event_category']); ?>
                    </span>
                    <br><br>
                    <p>
                        <span style="color:#00b9be;">
                        <?php print render($content['field_lead'][0]); ?>
                        </span>
                    </p>
                </div>

                <div class="content"<?php print $content_attributes; ?>>
                    <?php
// We hide the comments and links now so that we can render them later.
                    hide($content['field_place2book_tickets']); //<-- field provided by optional module ding_place2book
                    hide($content['field_category']);
                    hide($content['field_lead']);
                    hide($content['comments']);
                    hide($content['links']);
                    hide($content['field_title_image']);
                    hide($content['field_attachments']);
                    hide($content['field_tags']);
                    hide($content['field_info']);
                    hide($content['field_galleria']);
                    hide($content['field_target']);
                    hide($content['field_price']);
                    hide($content['field_location']);
                    hide($content['field_rum_og_sted']);
                    hide($content['field_dato']);
                    print render($content);
                    ?>
                </div>
                <p><?php print render($content['field_galleria']); ?></p>
                <div class="page-footer footer">
                    <?php if (!$teaser) : ?>
                      <p><?php print render($content['field_tags']); ?></p>
                      <?php if ($display_submitted): ?>
                        <div>
                            <?php print $user_picture; ?>
                            <div>
                                <h4>
                                    <?php print $kultur_theme_byline; ?>
                                    <?php print $name; ?>
                                </h4>
                                <p>
                                    <i class="glyphicon glyphicon-time"></i>
                                    <?php print $submitted; ?> • <?php print $kultur_theme_updated; ?>
                                </p>
                            </div>
                        </div>
                      <?php endif; ?>
                    <?php endif; ?>

                    <?php print render($content['links']); ?>
                    <?php print render($content['comments']); ?>
                </div>
            </div>

        </div>

        <div class="col-lg-2 col-md-4 col-sm-4 col-xs-12 col-sm-height col-md-height col-xs-height col-full-height col-top" style="background-color: #e5e5e5; padding-left:0;padding-right:0;">            
            <?php print render($content['field_title_image']); ?>
            <br>
            <div class="info-field">
                <p>
                    <i class="glyphicon glyphicon-calendar"></i> <?php print render($content['field_dato'][0]); ?>
                </p>
                <p>
                    <i class="glyphicon glyphicon-map-marker"></i> 
                    <?php if ($kultur_theme_event_location): ?>
                      <?php print $kultur_theme_event_location; ?>
                    <?php else: ?>	
                      <?php print t('See event info'); ?>
                    <?php endif; ?>
                </p>    
                <?php if (isset($content['field_target'][0])): ?>
                  <p>
                      <i class="glyphicon glyphicon-user"></i> <?php print render($content['field_target'][0]); ?>
                  </p>
                <?php endif; ?>    
                <p>
                    <?php if ($content['field_price']['#items'][0]['value'] != -10): ?>
                      <i class="glyphicon glyphicon-shopping-cart"></i> 
                      <?php if ($content['field_price']['#items'][0]['value'] == -1 || $content['field_price']['#items'][0]['value'] === "0"): ?>
                        <?php print t('Free'); ?>
                      <?php elseif (is_null($content['field_price']['#items'][0]['value'])) : ?>
                        <?php print t('Free registration'); ?>
                      <?php else: ?>	          
                        <?php print render($content['field_price'][0]); ?>
                      <?php endif; ?>
                  </p>
                <?php endif; ?> 

                <p><?php print render($content['field_attachments']); ?></p>
                <p><?php print render($content['field_info']); ?></p>

                <?php if ($kultur_theme_place2book_tickets): ?>
                  <p><?php print render($content['field_place2book_tickets'][0]); ?><p>
                    <?php endif; ?>
                      <?php if ($field_vis_mere['und'][0]['value'] == true): ?>
                    <div class="showmore"><?php print ('<a target="_blank" href="http://www.kultunaut.dk/perl/arrmore/type-nynaut?ArrNr=' . $nid . '">Se mere</a>'); ?></div>
                <?php endif; ?>      
            </div>
        </div>
    </div>
</div>