select 'Responsiveness' AS `criteria`,
`cs`.`transacting_office_id` AS `transacting_office_id`,
`to`.`transacting_office_name` AS `transacting_office_name`,
year(`cs`.`date_transacted`) AS `year_transacted`,
avg(`cs`.`responsiveness_rate_id`) AS `average_rating`,
avg(`cs`.`overall_rate_id`) AS `overall_rating` 
from (`css_responses` `cs` 
left join `transacting_offices` `to` on((`cs`.`transacting_office_id` = `to`.`id`))) 
where (`cs`.`status_type_id` = 1) 
group by year(`cs`.`date_transacted`),`cs`.`transacting_office_id` 

union all 

select 'Reliability' AS `criteria`,
`cs`.`transacting_office_id` AS `transacting_office_id`,
`to`.`transacting_office_name` AS `transacting_office_name`,
year(`cs`.`date_transacted`) AS `year_transacted`,
avg(`cs`.`reliability_rate_id`) AS `average_rating`,
avg(`cs`.`overall_rate_id`) AS `overall_rating` 
from (`css_responses` `cs` 
left join `transacting_offices` `to` on((`cs`.`transacting_office_id` = `to`.`id`))) 
where (`cs`.`status_type_id` = 1) 
group by year(`cs`.`date_transacted`),`cs`.`transacting_office_id` 

union all 

select 'Access and Facility' AS `criteria`,
`cs`.`transacting_office_id` AS `transacting_office_id`,
`to`.`transacting_office_name` AS `transacting_office_name`,
year(`cs`.`date_transacted`) AS `year_transacted`,
avg(`cs`.`facility_access_rate_id`) AS `average_rating`,
avg(`cs`.`overall_rate_id`) AS `overall_rating` 
from (`css_responses` `cs` 
left join `transacting_offices` `to` on((`cs`.`transacting_office_id` = `to`.`id`))) 
where (`cs`.`status_type_id` = 1) 
group by year(`cs`.`date_transacted`),`cs`.`transacting_office_id` 

union all 

select 'Communication' AS `criteria`,
`cs`.`transacting_office_id` AS `transacting_office_id`,
`to`.`transacting_office_name` AS `transacting_office_name`,
year(`cs`.`date_transacted`) AS `year_transacted`,
avg(`cs`.`communication_rate_id`) AS `average_rating`,
avg(`cs`.`overall_rate_id`) AS `overall_rating` 
from (`css_responses` `cs` 
left join `transacting_offices` `to` on((`cs`.`transacting_office_id` = `to`.`id`))) 
where (`cs`.`status_type_id` = 1) 
group by year(`cs`.`date_transacted`),`cs`.`transacting_office_id` 

union all 

select 'Cost' AS `criteria`,
`cs`.`transacting_office_id` AS `transacting_office_id`,
`to`.`transacting_office_name` AS `transacting_office_name`,
year(`cs`.`date_transacted`) AS `year_transacted`,
avg(`cs`.`cost_rate_id`) AS `average_rating`,
avg(`cs`.`overall_rate_id`) AS `overall_rating` 
from (`css_responses` `cs` 
left join `transacting_offices` `to` on((`cs`.`transacting_office_id` = `to`.`id`))) 
where (`cs`.`status_type_id` = 1) AND (`cs`.`cost_rate_id` IN(1, 2, 3, 4, 5))
group by year(`cs`.`date_transacted`),`cs`.`transacting_office_id` 

union all 

select 'Integrity' AS `criteria`,
`cs`.`transacting_office_id` AS `transacting_office_id`,
`to`.`transacting_office_name` AS `transacting_office_name`,
year(`cs`.`date_transacted`) AS `year_transacted`,
avg(`cs`.`integrity_rate_id`) AS `average_rating`,
avg(`cs`.`overall_rate_id`) AS `overall_rating` 
from (`css_responses` `cs` 
left join `transacting_offices` `to` on((`cs`.`transacting_office_id` = `to`.`id`))) 
where (`cs`.`status_type_id` = 1) 
group by year(`cs`.`date_transacted`),`cs`.`transacting_office_id` 

union all 

select 'Assurance' AS `criteria`,
`cs`.`transacting_office_id` AS `transacting_office_id`,
`to`.`transacting_office_name` AS `transacting_office_name`,
year(`cs`.`date_transacted`) AS `year_transacted`,
avg(`cs`.`assurance_rate_id`) AS `average_rating`,
avg(`cs`.`overall_rate_id`) AS `overall_rating` 
from (`css_responses` `cs` 
left join `transacting_offices` `to` on((`cs`.`transacting_office_id` = `to`.`id`))) 
where (`cs`.`status_type_id` = 1) 
group by year(`cs`.`date_transacted`),`cs`.`transacting_office_id` 

union all 

select 'Outcome' AS `criteria`,
`cs`.`transacting_office_id` AS `transacting_office_id`,
`to`.`transacting_office_name` AS `transacting_office_name`,
year(`cs`.`date_transacted`) AS `year_transacted`,
avg(`cs`.`outcome_rate_id`) AS `average_rating`,
avg(`cs`.`overall_rate_id`) AS `overall_rating` 
from (`css_responses` `cs` 
left join `transacting_offices` `to` on((`cs`.`transacting_office_id` = `to`.`id`))) 
where (`cs`.`status_type_id` = 1) 
group by year(`cs`.`date_transacted`),`cs`.`transacting_office_id` 

union all 

select 'Overall' AS `criteria`,
`cs`.`transacting_office_id` AS `transacting_office_id`,
`to`.`transacting_office_name` AS `transacting_office_name`,
year(`cs`.`date_transacted`) AS `year_transacted`,
avg(`cs`.`overall_rate_id`) AS `average_rating`,
avg(`cs`.`overall_rate_id`) AS `overall_rating` 
from (`css_responses` `cs` 
left join `transacting_offices` `to` on((`cs`.`transacting_office_id` = `to`.`id`))) 
where (`cs`.`status_type_id` = 1) 
group by year(`cs`.`date_transacted`),`cs`.`transacting_office_id`