<?php

namespace App\Exports;

use App\Models\CssResponse;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExportCssResponses implements FromQuery, WithMapping, WithHeadings
{
    use Exportable;

   protected $checked;

    public function __construct($checked)
    {
        $this->checked = $checked;
        
    }

    public function map($css_response): array
    {
        return [
            $css_response->id,
            $css_response->date_transacted,
            $css_response->date_accomplished,
            $css_response->client_name,
            $css_response->contact_details,
            optional($css_response->sex_type)->sex_type_name,
            optional($css_response->client_group)->client_group_name,
            optional($css_response->client_type)->client_type_name,
            $css_response->specify_client_type,
            optional($css_response->region)->region_name,
            optional($css_response->transacting_office)->transacting_office_name,
            optional($css_response->availed_service->service_type)->service_type_name,
            optional($css_response->availed_service->service_category)->service_category_name,
            optional($css_response->availed_service)->availed_service_name,
            $css_response->other_service_availed,
            optional($css_response->awareness_response)->awareness_response_name,
            optional($css_response->visibility_response)->visibility_response_name,
            optional($css_response->helpfulness_response)->helpfulness_response_name,
            optional($css_response->responsiveness_rate)->rating_name,
            $css_response->responsiveness_remarks,
            optional($css_response->reliability_rate)->rating_name,
            $css_response->reliability_remarks,
            optional($css_response->facility_access_rate)->rating_name,
            $css_response->facility_access_remarks,
            optional($css_response->communication_rate)->rating_name,
            $css_response->communication_remarks,
            optional($css_response->cost_rate)->rating_name,
            $css_response->cost_remarks,
            optional($css_response->integrity_rate)->rating_name,
            $css_response->integrity_remarks,
            optional($css_response->assurance_rate)->rating_name,
            $css_response->assurance_remarks,
            optional($css_response->outcome_rate)->rating_name,
            $css_response->outcome_remarks,
            optional($css_response->overall_rate)->rating_name,
            $css_response->overall_remarks,
            $css_response->created_at,


        ];
    }

    public function headings(): array
    {
        return [
            'ID',
            'Date Transacted',
            'Date Accomplished',
            'Client Name',
            'Contact Details',
            'Sex',
            'Client Group',
            'Client Type',
            'Region',
            'Specify Client Type',
            'Transacting Office',
            'Service Type',
            'Service Category',
            'Availed Service',
            'Other Availed Service',
            'Awareness',
            'Visibility',
            'Helpfulness',
            'Responsiveness Rating',
            'Responsiveness Remarks',
            'Reliability Rating',
            'Reliability Remarks',
            'Facility Rating',
            'Facility Remarks',
            'Communication Rating',
            'Communication Remarks',
            'Cost Rating',
            'Cost Remarks',
            'Integrity Rating',
            'Integrity Remarks',
            'Assurance Rating',
            'Assurance Remarks',
            'Outcome Rating',
            'Outcome Remarks',
            'Overall Rating',
            'Overall Remarks',
            'Created at'
        ];
    }

    public function query()
    {
        return CssResponse::whereIn('id', $this->checked);
    }
}
