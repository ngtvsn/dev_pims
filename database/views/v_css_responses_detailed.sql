select `cs`.`date_transacted` AS `date_transacted`,
`cs`.`sex_type_id` AS `sex_type_id`,
`se`.`sex_type_name` AS `sex_type_name`,
`cs`.`client_group_id` AS `client_group_id`,
`cg`.`client_group_name` AS `client_group_name`,
`cs`.`client_type_id` AS `client_type_id`,
`cl`.`client_type_name` AS `client_type_name`,
`cs`.`region_id` AS `region_id`,
`re`.`region_name` AS `region_name`,
`cs`.`transacting_office_id` AS `transacting_office_id`,
`tr`.`transacting_office_name` AS `transacting_office_name`,
`cs`.`availed_service_id` AS `availed_service_id`,
`av`.`availed_service_name_short` AS `availed_service_name_short`,
`cs`.`awareness_response_id` AS `awareness_response_id`,
`ar`.`awareness_response_name` AS `awareness_response_name`,
`cs`.`visibility_response_id` AS `visibility_response_id`,
`vr`.`visibility_response_name` AS `visibility_response_name`,
`cs`.`helpfulness_response_id` AS `helpfulness_response_id`,
`hr`.`helpfulness_response_name` AS `helpfulness_response_name`,
`cs`.`responsiveness_rate_id` AS `responsiveness_rate_id`,
`r1`.`rating_name` AS `responsiveness_rate_name`,
`cs`.`reliability_rate_id` AS `reliability_rate_id`,
`r2`.`rating_name` AS `reliability_rate_name`,
`cs`.`facility_access_rate_id` AS `facility_access_rate_id`,
`r3`.`rating_name` AS `facility_access_rate_name`,
`cs`.`communication_rate_id` AS `communication_rate_id`,
`r4`.`rating_name` AS `communication_rate_name`,
`cs`.`cost_rate_id` AS `cost_rate_id`,
`r5`.`rating_name` AS `cost_rate_name`,
`cs`.`integrity_rate_id` AS `integrity_rate_id`,
`r6`.`rating_name` AS `integrity_rate_name`,
`cs`.`assurance_rate_id` AS `assurance_rate_id`,
`r7`.`rating_name` AS `assurance_rate_name`,
`cs`.`outcome_rate_id` AS `outcome_rate_id`,
`r8`.`rating_name` AS `outcome_rate_name`,
`cs`.`overall_rate_id` AS `overall_rate_id`,
`r9`.`rating_name` AS `overall_rate_name` 
from ((((((((((((((((((`css_responses` `cs` 
left join `sex_types` `se` on((`cs`.`sex_type_id` = `se`.`id`))) 
left join `client_types` `cl` on((`cs`.`client_type_id` = `cl`.`id`))) 
left join `client_groups` `cg` on((`cs`.`client_group_id` = `cg`.`id`))) 
left join `regions` `re` on((`cs`.`region_id` = `re`.`id`))) 
left join `transacting_offices` `tr` on((`cs`.`transacting_office_id` = `tr`.`id`))) 
left join `availed_services` `av` on((`cs`.`availed_service_id` = `av`.`id`))) 
left join `awareness_responses` `ar` on((`cs`.`awareness_response_id` = `ar`.`id`))) 
left join `visibility_responses` `vr` on((`cs`.`visibility_response_id` = `vr`.`id`))) 
left join `helpfulness_responses` `hr` on((`cs`.`helpfulness_response_id` = `hr`.`id`))) 
left join `ratings` `r1` on((`cs`.`responsiveness_rate_id` = `r1`.`id`))) 
left join `ratings` `r2` on((`cs`.`reliability_rate_id` = `r2`.`id`))) 
left join `ratings` `r3` on((`cs`.`facility_access_rate_id` = `r3`.`id`))) 
left join `ratings` `r4` on((`cs`.`communication_rate_id` = `r4`.`id`))) 
left join `ratings` `r5` on((`cs`.`cost_rate_id` = `r5`.`id`))) 
left join `ratings` `r6` on((`cs`.`integrity_rate_id` = `r6`.`id`))) 
left join `ratings` `r7` on((`cs`.`assurance_rate_id` = `r7`.`id`))) 
left join `ratings` `r8` on((`cs`.`outcome_rate_id` = `r8`.`id`))) 
left join `ratings` `r9` on((`cs`.`overall_rate_id` = `r9`.`id`))) 
where (`cs`.`status_type_id` = 1)