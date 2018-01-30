<?php
require $_SERVER['DOCUMENT_ROOT'] . "/jarvis/site/core/model.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/jarvis/site/models/phpUtils.php";

class Calendar extends model
{
    
    private $days_name = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
    private $order_days_name = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
    private $months_name = [
        'January',
        'Februari',
        'March',
        'April',
        'May',
        'June',
        'July',
        'August',
        'September',
        'Oktober',
        'November',
        'December'
    ];
    
    private $curYear;
    private $curMonth;
    
    public function __construct($month = false, $year = false)
    {
    	
    	if ($month !== false) {
    		$this->curMonth = $month;
		}
		if ($year !== false) {
    		$this->curYear = $year;
		}
        
        parent::__construct();
        
    }
    
    
    public function currentMonth()
    {
        
        $months = $this->months_name[date('n') - 1];
        
        return $months;
        
    }
    
    
    public function currentMonthNumb()
    {
        
        $nowDatTime = new DateTime();
        $months     = $nowDatTime->format('m');
        
        return $months;
        
        
    }
    
    
    public function currentDay()
    {
        
        $date    = new DateTime();
        $dayName = substr(str_replace(0, 7, $this->days_name[$date->format('w')]), 0, 3);
        $dayNumb = $date->format('j');
        $month   = $this->currentMonth();
        
        $current_day = $dayName . ' ' . $dayNumb . ' ' . $month;
        
        $hour        = $date->format('H');
        $min         = $date->format('i');
        $currentTime = $hour . ":" . $min;
        
        $dateTimeArr = ['dateNow' => $current_day, 'timeNow' => $currentTime];
        
        $date->add(new DateInterval('P1M'));
        
        return $dateTimeArr;
        
    }
    
    public function getUsers()
    {
        
        $users = $this->PDO()->query("SELECT *
									  FROM users
									  ORDER BY `firstname`");
        
        $return = '';
        foreach ($users->fetchAll(PDO::FETCH_ASSOC) as $user) {
            if ($_COOKIE['filter'] == $user['user_id']) {
                $return .= '
					<div class="owner" style="color: ' . $user['color'] . '" data-id="' . $user['user_id'] . '">
						<span class="filterActive">
							' . $user['firstname'] . '
							<i class="fa fa-times-circle" aria-hidden="true"></i>
						</span>
					</div>
					';
            } else {
                $return .= '
					<div class="owner" style="color: ' . $user['color'] . '" data-id="' . $user['user_id'] . '">
						<span>
							' . $user['firstname'] . '
						</span>
					</div>
					';
            }
        }
        
        return $return;
    }
    
    
    public function agenda()
    {
     
    	if (isset($this->curMonth)) {
    		$month = $this->curMonth;
		}
		else {
    		$month = $this->currentMonthNumb();
    		$this->curMonth = $month;
		}
		
		if (isset($this->curYear)) {
    		$currentYear = $this->curYear;
		}
		else {
    		$currentYear = date('Y');
    		$this->curYear = $currentYear;
		}
        
        $date        = new DateTime($currentYear . '-' . $month . '-01');
        $calendar    = array();
        
        while ($date->format('Y') <= $currentYear) {
            
            $year   = $date->format('Y');
            $months = /*$date->format('m')*/$this->currentMonthNumb();
            $days   = $date->format('j');
            $weeks  = str_replace(0, 7, $this->days_name[$date->format('w')]);
            
            $calendar[$year][$months][$days] = $weeks;
            
            $date->add(new DateInterval('P1D'));
            
        }
        
        return current($calendar);
        
    }
    
    
    public function eventNotifier($eventDay)
    {
        
        if (isset($_COOKIE['current_mode']) && $_COOKIE['current_mode'] !== 'open') {
            
            if (isset($_COOKIE['filter']) && $_COOKIE['filter'] > 0) {
            	
            	$filter = intval($_COOKIE['filter']);
                
                $eventNotificationAuthors = $this->PDO()->prepare("SELECT u.`firstname`, u.color
													FROM users u
													LEFT JOIN events e
													ON u.user_id = e.added_by
													WHERE e.`start_date` = ?
													  AND u.user_id = ?");
                
                $eventNotificationInvitees = $this->PDO()->prepare("SELECT u.firstname, u.color
													FROM invites i
													LEFT JOIN events e
													ON i.event_id = e.id
													LEFT JOIN users u
													ON i.user_id = u.user_id
													WHERE e.`start_date` = ?
													  AND i.user_id = ?");
                
                $eventNotificationAuthors->execute(array(date('Y-m-d', strtotime($eventDay)), $filter));
                $eventNotificationInvitees->execute(array(date('Y-m-d', strtotime($eventDay)), $filter));
                
                $eventNotification = array_merge($eventNotificationAuthors->fetchAll(PDO::FETCH_ASSOC),
                    $eventNotificationInvitees->fetchAll(PDO::FETCH_ASSOC));
                $eventNotification = array_unique_multidimensional($eventNotification);
                if (count($eventNotification) > 0) {
                    
                    foreach ($eventNotification as $displayNotificationBar) {
                        
                        ?>

						<hr class="notificationBar"
							style="border: 1px solid <?= $displayNotificationBar['color'] ?>; width: 100%; color: <?= $displayNotificationBar['color'] ?>;" />
                        
                        <?php
                        
                    }
                }
            } else {
                $eventNotificationAuthors = $this->PDO()->prepare("SELECT u.`firstname`, u.color
													FROM users u
													LEFT JOIN events e
													ON u.user_id = e.added_by
													WHERE e.`start_date` = ?");
                
                $eventNotificationInvitees = $this->PDO()->prepare("SELECT u.firstname, u.color
													FROM invites i
													LEFT JOIN events e
													ON i.event_id = e.id
													LEFT JOIN users u
													ON i.user_id = u.user_id
													WHERE e.`start_date` = ?");
                
                $eventNotificationAuthors->execute(array(date('Y-m-d', strtotime($eventDay))));
                $eventNotificationInvitees->execute(array(date('Y-m-d', strtotime($eventDay))));
                
                $eventNotification = array_merge($eventNotificationAuthors->fetchAll(PDO::FETCH_ASSOC),
                    $eventNotificationInvitees->fetchAll(PDO::FETCH_ASSOC));
                $eventNotification = array_unique_multidimensional($eventNotification);
                if (count($eventNotification) > 0) {
                    
                    foreach ($eventNotification as $displayNotificationBar) {
                        
                        ?>

						<hr class="notificationBar"
							style="border: 1px solid <?= $displayNotificationBar['color'] ?>; width: 100%; color: <?= $displayNotificationBar['color'] ?>;" />
                        
                        <?php
                        
                    }
                }
            }
        }
        
    }
    
    
    public function display_calendar()
    {
        
        $calendar = $this->agenda();
        foreach ($calendar as $months => $days) {
            
            ?>

			<div class="monthsCont" id="<?php echo $months . date('Y'); ?>" data-month="<?=$this->curMonth?>" data-year="<?=$this->curYear?>">

				<div class="weeksName">
                    
                    <?php
                    
                    foreach ($this->order_days_name as $weeks) {
                        
                        $subWeeks = substr($weeks, 0, 2);
                        ?>

						<h3><?php echo $subWeeks; ?></h3>
                        
                        <?php
                        
                    }
                    
                    ?>

				</div>

				<div class="days">
                    
                    <?php
                    
                    foreach ($days as $day => $week) {
                        
                        ?>

						<div class="daysNumb">
                            
                            <?php
                            
                            if ($day == date('j')) {
                                
                                ?>

								<p class="<?php echo $months; ?>"
								   style="color: #F65F59; transform: scale(1.5,1.5);"><?php echo $day; ?></p>
                                
                                <?php
                                
                            } else {
                                
                                ?>

								<p class="<?php echo $months; ?>"><?php echo $day; ?></p>
                                
                                <?php
                                
                            }
                            
                            ?>

							<div class="eventNotification">
                                
                                <?php
                                
                                $cur_year  = date('Y');
                                $cur_month = date('m');
                                
                                $dayEvents = $day . '-' . $cur_month . '-' . $cur_year;
                                $this->eventNotifier($dayEvents);
                                
                                ?>

							</div>

						</div>
                        
                        <?php
                        
                    }
                    
                    ?>

				</div>

			</div>
            
            <?php
            
        }
        
    }
    
}


