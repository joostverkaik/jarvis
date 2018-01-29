<?php

require "pdo_connection.php";
$pdo = pdo();

$current_mode = $_COOKIE['current_mode'];

$filter = intval($_COOKIE['filter']);

$dateNumb = htmlentities(htmlspecialchars($_GET['dateNumb']));
$curMonth = htmlentities(htmlspecialchars($_GET['curMonth']));
$curYear  = date('Y');

$date = $dateNumb . '-' . $curMonth . '-' . $curYear;

$dto = new DateTime();
$dto->setISODate($curYear, date('W', strtotime($date)));
$week_start_sql = $dto->format('Y-m-d');
$dto->modify('+7 days');
$week_end_sql = $dto->format('Y-m-d');

$events = $pdo->prepare("SELECT e.*, u.color
						 FROM events e
						 LEFT JOIN users u
						 ON u.user_id = e.added_by
						 WHERE e.start_date BETWEEN ? AND ?");
$events->execute([$week_start_sql, $week_end_sql]);

$dto = new DateTime();
$dto->setISODate($curYear, date('W', strtotime($date)));
$week_start = $dto->format('d-m-Y');
$dto->modify('+7 days');
$week_end = $dto->format('d-m-Y');

$period = new DatePeriod(
    new DateTime($week_start),
    new DateInterval('P1D'),
    new DateTime($week_end)
);

$period_array = iterator_to_array($period);

$events_array = [];
foreach ($events->fetchAll(PDO::FETCH_ASSOC) as $event) {
    
    if ($filter > 0) {
        if ($event['added_by'] == $filter) {
            $events_array[$event['start_date']][substr($event['start_time'], 0, 2)][$event['id']] = $event;
            
            $invitees = $pdo->prepare("SELECT i.*, u.color
							   FROM invites i
							   LEFT JOIN users u
							   ON u.user_id = i.user_id
							   WHERE i.event_id = ?");
            $invitees->execute([$event['id']]);
            
            $events_array[$event['start_date']][substr($event['start_time'], 0,
                2)][$event['id']]['invitees'] = $invitees->fetchAll();
        }
    } else {
        $events_array[$event['start_date']][substr($event['start_time'], 0, 2)][$event['id']] = $event;
        
        $invitees = $pdo->prepare("SELECT i.*, u.color
							   FROM invites i
							   LEFT JOIN users u
							   ON u.user_id = i.user_id
							   WHERE i.event_id = ?");
        $invitees->execute([$event['id']]);
        
        $events_array[$event['start_date']][substr($event['start_time'], 0,
            2)][$event['id']]['invitees'] = $invitees->fetchAll();
    }
}

if ($filter > 0) {
    $sharedEvents = $pdo->prepare("SELECT e.id
							   FROM invites i
							   LEFT JOIN users u
							   ON u.user_id = i.user_id
							   LEFT JOIN events e
							   ON e.id = i.event_id
							   WHERE u.user_id = ?
						  		 AND e.start_date BETWEEN ? AND ?");
    $sharedEvents->execute([$filter, $week_start_sql, $week_end_sql]);
    
    if ($sharedEvents->rowCount() > 0) {
     
    	$sharedEventsData = array_column($sharedEvents->fetchAll(), 'id');
        $events = $pdo->prepare("SELECT e.*, u.color
						 FROM events e
						 LEFT JOIN users u
						 ON u.user_id = e.added_by
						 WHERE e.id IN (" . str_repeat('?, ', $sharedEvents->rowCount() - 1) . "?)");
        $events->execute($sharedEventsData);
        
        foreach ($events->fetchAll(PDO::FETCH_ASSOC) as $event) {
        	if (!isset($events_array[$event['start_date']][substr($event['start_time'], 0, 2)][$event['id']])) {
                $events_array[$event['start_date']][substr($event['start_time'], 0, 2)][$event['id']] = $event;
        
                $invitees = $pdo->prepare("SELECT i.*, u.color
							   FROM invites i
							   LEFT JOIN users u
							   ON u.user_id = i.user_id
							   WHERE i.event_id = ?");
                $invitees->execute([$event['id']]);
        
                $events_array[$event['start_date']][substr($event['start_time'], 0,
                    2)][$event['id']]['invitees'] = $invitees->fetchAll();
            }
        }
    }
}

?>
<div class="monthsCont" id="January2018">

	<div class="weeksNameWeekView">
		<h3>&nbsp;</h3>

		<h3>Mo<br><?= $period_array[0]->format('d'); ?></h3>

		<h3>Tu<br><?= $period_array[1]->format('d'); ?></h3>

		<h3>We<br><?= $period_array[2]->format('d'); ?></h3>

		<h3>Th<br><?= $period_array[3]->format('d'); ?></h3>

		<h3>Fr<br><?= $period_array[4]->format('d'); ?></h3>

		<h3>Sa<br><?= $period_array[5]->format('d'); ?></h3>

		<h3>Su<br><?= $period_array[6]->format('d'); ?></h3>

	</div>

	<div class="row scrollablediv">
		<div class="hours column">
			<h4>00:00</h4>
			<h4>01:00</h4>
			<h4>02:00</h4>
			<h4 id="scrollto">03:00</h4>
			<h4>04:00</h4>
			<h4>05:00</h4>
			<h4>06:00</h4>
			<h4>07:00</h4>
			<h4>08:00</h4>
			<h4>09:00</h4>
			<h4>10:00</h4>
			<h4>11:00</h4>
			<h4>12:00</h4>
			<h4>13:00</h4>
			<h4>14:00</h4>
			<h4>15:00</h4>
			<h4>16:00</h4>
			<h4>17:00</h4>
			<h4>18:00</h4>
			<h4>19:00</h4>
			<h4>20:00</h4>
			<h4>21:00</h4>
			<h4>22:00</h4>
			<h4>23:00</h4>
			<h4>00:00</h4>
		</div>
        <?php
        foreach ($period as $date) {
            ?>
			<div class="column" style="position: relative;">
                <?php
                if ($current_mode !== 'open') {
                    $events_day = isset($events_array[$date->format('Y-m-d')]) ? $events_array[$date->format('Y-m-d')] : [];
                    for ($i = 0; $i < 24; $i++) {
                        ?>
						<div class="whiteBlock" data-date="<?= $date->format('d-m-Y') . " " . $i . ":00:00" ?>"></div>
                        <?php
                        
                        if (isset($events_day[zerofill($i, 2)]) && count($events_day[zerofill($i, 2)]) > 0) {
                            foreach ($events_day[zerofill($i, 2)] as $event) {
                                $d1           = new DateTime($event['start_date'] . " " . $event['start_time']);
                                $d2           = new DateTime($event['end_date'] . " " . $event['end_time']);
                                $diff         = $d2->diff($d1);
                                $hours_diff   = $diff->h;
                                $minutes_diff = $diff->i;
                                $pixels       = $hours_diff + ($minutes_diff / 60);
                                
                                $event_name = '';
                                if ($current_mode == 'private') {
                                    if ($event['added_by'] == '1') {
                                        $event_name = $event['name'];
                                    } elseif ($event['added_by'] != '1' && $event['private'] == '0') {
                                        $event_name = $event['name'];
                                    } elseif ($event['added_by'] != '1' && $event['private'] == '1') {
                                        $event_name = 'Private event';
                                    }
                                } elseif ($current_mode == 'collective') {
                                    if ($event['private'] == '1') {
                                        $event_name = 'Private event';
                                    } else {
                                        $event_name = $event['name'];
                                    }
                                }
                                ?>
								<div class="event"
									 style="top: <?= ($i * 51) + 10 ?>px; height: <?= ($pixels * 51) ?>px;"
									 data-id="<?= $event_name === 'Private event' ? '0' : $event['id'] ?>">
									<h5><?= $event_name ?></h5>
                                    <?php
                                    $total_users = 1 + count($event['invitees']);
                                    $block_width = 100 / $total_users;
                                    $invitees    = array_merge([$event], $event['invitees']);
                                    foreach ($invitees as $invite) {
                                        ?>
										<div style="width: <?= $block_width ?>%;">
											<div class="user"
												 style="background-color: <?= $invite['color'] ?>; border-bottom: 1px solid <?= $invite['color'] ?>;"></div>
										</div>
                                        <?php
                                    }
                                    ?>
								</div>
                                <?php
                            }
                        }
                    }
                } else {
                    for ($i = 0; $i < 24; $i++) {
                        ?>
						<div class="whiteBlock" data-date="<?= $date->format('d-m-Y') . " " . $i . ":00:00" ?>"></div>
                        <?php
                    }
                }
                ?>
			</div>
            <?php
        }
        ?>
	</div>
</div>
