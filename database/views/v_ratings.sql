select 'Responsiveness' AS `criteria`,
year(`cs`.`date_transacted`) AS `year_transacted`,
`cs`.`transacting_office_id` AS `transacting_office_id`,
`tr`.`transacting_office_name` AS `transacting_office_name`,
count(`cs`.`id`) AS `total_responses`,
0 AS `rating_6`,
sum((case when (`cs`.`responsiveness_rate_id` = 5) then 1 else 0 end)) AS `rating_5`,
sum((case when (`cs`.`responsiveness_rate_id` = 4) then 1 else 0 end)) AS `rating_4`,
sum((case when (`cs`.`responsiveness_rate_id` = 3) then 1 else 0 end)) AS `rating_3`,
sum((case when (`cs`.`responsiveness_rate_id` = 2) then 1 else 0 end)) AS `rating_2`,
sum((case when (`cs`.`responsiveness_rate_id` = 1) then 1 else 0 end)) AS `rating_1` 
from (`css_responses` `cs` left join `transacting_offices` `tr` on((`cs`.`transacting_office_id` = `tr`.`id`))) 
where (`cs`.`status_type_id` = 1) 
group by year(`cs`.`date_transacted`),`cs`.`transacting_office_id`
 
union all 

select 
'Reliability' AS `criteria`,
year(`cs`.`date_transacted`) AS `year_transacted`,
`cs`.`transacting_office_id` AS `transacting_office_id`,
`tr`.`transacting_office_name` AS `transacting_office_name`,
count(`cs`.`id`) AS `total_responses`,
0 AS `rating_6`,
sum((case when (`cs`.`reliability_rate_id` = 5) then 1 else 0 end)) AS `rating_5`,
sum((case when (`cs`.`reliability_rate_id` = 4) then 1 else 0 end)) AS `rating_4`,
sum((case when (`cs`.`reliability_rate_id` = 3) then 1 else 0 end)) AS `rating_3`,
sum((case when (`cs`.`reliability_rate_id` = 2) then 1 else 0 end)) AS `rating_2`,
sum((case when (`cs`.`reliability_rate_id` = 1) then 1 else 0 end)) AS `rating_1` 
from (`css_responses` `cs` left join `transacting_offices` `tr` on((`cs`.`transacting_office_id` = `tr`.`id`))) 
where (`cs`.`status_type_id` = 1) 
group by year(`cs`.`date_transacted`),`cs`.`transacting_office_id`
 
union all 

select 
'Access and Facility' AS `criteria`,
year(`cs`.`date_transacted`) AS `year_transacted`,
`cs`.`transacting_office_id` AS `transacting_office_id`,
`tr`.`transacting_office_name` AS `transacting_office_name`,
count(`cs`.`id`) AS `total_responses`,
0 AS `rating_6`,
sum((case when (`cs`.`facility_access_rate_id` = 5) then 1 else 0 end)) AS `rating_5`,
sum((case when (`cs`.`facility_access_rate_id` = 4) then 1 else 0 end)) AS `rating_4`,
sum((case when (`cs`.`facility_access_rate_id` = 3) then 1 else 0 end)) AS `rating_3`,
sum((case when (`cs`.`facility_access_rate_id` = 2) then 1 else 0 end)) AS `rating_2`,
sum((case when (`cs`.`facility_access_rate_id` = 1) then 1 else 0 end)) AS `rating_1` 
from (`css_responses` `cs` left join `transacting_offices` `tr` on((`cs`.`transacting_office_id` = `tr`.`id`))) 
where (`cs`.`status_type_id` = 1) 
group by year(`cs`.`date_transacted`),`cs`.`transacting_office_id`
 
union all 

select 
'Communication' AS `criteria`,
year(`cs`.`date_transacted`) AS `year_transacted`,
`cs`.`transacting_office_id` AS `transacting_office_id`,
`tr`.`transacting_office_name` AS `transacting_office_name`,
count(`cs`.`id`) AS `total_responses`,
0 AS `rating_6`,
sum((case when (`cs`.`communication_rate_id` = 5) then 1 else 0 end)) AS `rating_5`,
sum((case when (`cs`.`communication_rate_id` = 4) then 1 else 0 end)) AS `rating_4`,
sum((case when (`cs`.`communication_rate_id` = 3) then 1 else 0 end)) AS `rating_3`,
sum((case when (`cs`.`communication_rate_id` = 2) then 1 else 0 end)) AS `rating_2`,
sum((case when (`cs`.`communication_rate_id` = 1) then 1 else 0 end)) AS `rating_1` 
from (`css_responses` `cs` left join `transacting_offices` `tr` on((`cs`.`transacting_office_id` = `tr`.`id`))) 
where (`cs`.`status_type_id` = 1) 
group by year(`cs`.`date_transacted`),`cs`.`transacting_office_id`
 
union all 

select 
'Cost' AS `criteria`,
year(`cs`.`date_transacted`) AS `year_transacted`,
`cs`.`transacting_office_id` AS `transacting_office_id`,
`tr`.`transacting_office_name` AS `transacting_office_name`,
count(`cs`.`id`) AS `total_responses`,
sum((case when (`cs`.`cost_rate_id` = 6) then 1 else 0 end)) AS `rating_6`,
sum((case when (`cs`.`cost_rate_id` = 5) then 1 else 0 end)) AS `rating_5`,
sum((case when (`cs`.`cost_rate_id` = 4) then 1 else 0 end)) AS `rating_4`,
sum((case when (`cs`.`cost_rate_id` = 3) then 1 else 0 end)) AS `rating_3`,
sum((case when (`cs`.`cost_rate_id` = 2) then 1 else 0 end)) AS `rating_2`,
sum((case when (`cs`.`cost_rate_id` = 1) then 1 else 0 end)) AS `rating_1` 
from (`css_responses` `cs` left join `transacting_offices` `tr` on((`cs`.`transacting_office_id` = `tr`.`id`))) 
where (`cs`.`status_type_id` = 1) 
group by year(`cs`.`date_transacted`),`cs`.`transacting_office_id`
 
union all 

select 
'Integrity' AS `criteria`,
year(`cs`.`date_transacted`) AS `year_transacted`,
`cs`.`transacting_office_id` AS `transacting_office_id`,
`tr`.`transacting_office_name` AS `transacting_office_name`,
count(`cs`.`id`) AS `total_responses`,
0 AS `rating_6`,
sum((case when (`cs`.`integrity_rate_id` = 5) then 1 else 0 end)) AS `rating_5`,
sum((case when (`cs`.`integrity_rate_id` = 4) then 1 else 0 end)) AS `rating_4`,
sum((case when (`cs`.`integrity_rate_id` = 3) then 1 else 0 end)) AS `rating_3`,
sum((case when (`cs`.`integrity_rate_id` = 2) then 1 else 0 end)) AS `rating_2`,
sum((case when (`cs`.`integrity_rate_id` = 1) then 1 else 0 end)) AS `rating_1` 
from (`css_responses` `cs` left join `transacting_offices` `tr` on((`cs`.`transacting_office_id` = `tr`.`id`))) 
where (`cs`.`status_type_id` = 1) 
group by year(`cs`.`date_transacted`),`cs`.`transacting_office_id`
 
union all 

select 
'Assurance' AS `criteria`,
year(`cs`.`date_transacted`) AS `year_transacted`,
`cs`.`transacting_office_id` AS `transacting_office_id`,
`tr`.`transacting_office_name` AS `transacting_office_name`,
count(`cs`.`id`) AS `total_responses`,
0 AS `rating_6`,
sum((case when (`cs`.`assurance_rate_id` = 5) then 1 else 0 end)) AS `rating_5`,
sum((case when (`cs`.`assurance_rate_id` = 4) then 1 else 0 end)) AS `rating_4`,
sum((case when (`cs`.`assurance_rate_id` = 3) then 1 else 0 end)) AS `rating_3`,
sum((case when (`cs`.`assurance_rate_id` = 2) then 1 else 0 end)) AS `rating_2`,
sum((case when (`cs`.`assurance_rate_id` = 1) then 1 else 0 end)) AS `rating_1` 
from (`css_responses` `cs` left join `transacting_offices` `tr` on((`cs`.`transacting_office_id` = `tr`.`id`))) 
where (`cs`.`status_type_id` = 1) 
group by year(`cs`.`date_transacted`),`cs`.`transacting_office_id`
 
union all 

select 
'Outcome' AS `criteria`,
year(`cs`.`date_transacted`) AS `year_transacted`,
`cs`.`transacting_office_id` AS `transacting_office_id`,
`tr`.`transacting_office_name` AS `transacting_office_name`,
count(`cs`.`id`) AS `total_responses`,
0 AS `rating_6`,
sum((case when (`cs`.`outcome_rate_id` = 5) then 1 else 0 end)) AS `rating_5`,
sum((case when (`cs`.`outcome_rate_id` = 4) then 1 else 0 end)) AS `rating_4`,
sum((case when (`cs`.`outcome_rate_id` = 3) then 1 else 0 end)) AS `rating_3`,
sum((case when (`cs`.`outcome_rate_id` = 2) then 1 else 0 end)) AS `rating_2`,
sum((case when (`cs`.`outcome_rate_id` = 1) then 1 else 0 end)) AS `rating_1` 
from (`css_responses` `cs` left join `transacting_offices` `tr` on((`cs`.`transacting_office_id` = `tr`.`id`))) 
where (`cs`.`status_type_id` = 1) 
group by year(`cs`.`date_transacted`),`cs`.`transacting_office_id`
 
union all 

select 
'Overall' AS `criteria`,
year(`cs`.`date_transacted`) AS `year_transacted`,
`cs`.`transacting_office_id` AS `transacting_office_id`,
`tr`.`transacting_office_name` AS `transacting_office_name`,
count(`cs`.`id`) AS `total_responses`,
0 AS `rating_6`,
sum((case when (`cs`.`overall_rate_id` = 5) then 1 else 0 end)) AS `rating_5`,
sum((case when (`cs`.`overall_rate_id` = 4) then 1 else 0 end)) AS `rating_4`,
sum((case when (`cs`.`overall_rate_id` = 3) then 1 else 0 end)) AS `rating_3`,
sum((case when (`cs`.`overall_rate_id` = 2) then 1 else 0 end)) AS `rating_2`,
sum((case when (`cs`.`overall_rate_id` = 1) then 1 else 0 end)) AS `rating_1` 
from (`css_responses` `cs` left join `transacting_offices` `tr` on((`cs`.`transacting_office_id` = `tr`.`id`))) 
where (`cs`.`status_type_id` = 1) 
group by year(`cs`.`date_transacted`),`cs`.`transacting_office_id`