<div class="tools">

	<img src="public/media/notes/new_note.png" alt="" id="addNote">

	<div class="toolsHeader">

		<div class="modes">

			<div id="audiowaves">
				<span></span>
				<span></span>
				<span></span>
				<span></span>
				<span></span>
			</div>

		</div>

		<div id="micro">
			<i class="fa fa-microphone" aria-hidden="true"></i>
		</div>

	</div>

</div>

<div id="note" style="display:none; cursor: default; color: #000;">
	<canvas id="draw_note" height="300" width="550"></canvas>

	<p style="width: 100%; border-top: 1px solid #000; color: #000;">Share with:</p>
	<div class="invited">
        <?php
        $model = new model();
        $users = $model->prepare("SELECT *
										  FROM users
										  WHERE user_id != 1
										  ORDER BY `firstname`", []);
        
        foreach ($users->fetchAll(PDO::FETCH_ASSOC) as $user) {
            ?>
			<div class="inputsInvited">
				<p style="color: <?= $user['color'] ?>;"><label><span><input type="checkbox" name="invitees[]"
																			 class="invitedCheckbox"
																			 value="<?= $user['user_id'] ?>"></span> <?= $user['firstname'] ?>
					</label></p>
			</div>
            <?php
        }
        ?>
	</div>
    <?php
    if (isset($_COOKIE['current_mode']) && $_COOKIE['current_mode'] === 'private') {
        ?>
		<p>Is this a private note?</p>
		<div class="private_event">
			<p><label><input type="checkbox" name="private" id="private" class="privateEvent"
							 value="1"> Yes</label></p>
		</div>
        <?php
    } else {
        ?>
		<input type="hidden" name="private" id="private" class="privateEvent" value="0">
		<p>To make this a private note, make sure you are in private mode first.</p>
        <?php
    }
    ?>
	<p>
		<button id="saveNote">Save note</button>
	</p>
</div>
