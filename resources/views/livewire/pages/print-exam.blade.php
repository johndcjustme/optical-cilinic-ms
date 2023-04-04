<div>
    {{-- {{ $rf->purchase }}
    @foreach ($rf->purchase as $purchase)
        {{$purchase->purchase_details->where('order_status', '!=', null)}}
    @endforeach --}}
    <div id="printme">
        <div style="max-width: 4.4in;">
            <h4 id="refraction-for" style="text-align: center; margin:0.5rem 0">
                {{-- @if (!is_null($rf->purchase))
                    ORDER
                @else
                    LABORATORY
                @endif --}}
                LABORATORY
            </h4>
            <table class="refraction">
                <tr>
                    <td colspan="6">        
                        <b>Name:</b> 
                        {{ $rf->patient->name }}
                    </td>
                    <td> 
                        <b>Age:</b>
                        {{ $rf->patient->age }}
                    </td>
                </tr>
                <tr>
                    <td colspan="6">
                        <b>Occupation:</b>
                        {{ $rf->patient->occupation }}
                    </td>
                    <td colspan="1">
                        <b>Phone:</b>
                        {{ $rf->patient->mobile_1 }}
                    </td>
                </tr>
                <tr>
                    <td colspan="7">
                        <b>Address:</b> 
                        {{ $rf->patient->address }}
                    </td>
                </tr>
            </table>

            <table class="refraction">
                <tr>
                    <th colspan="7">REFRACTION</th>
                </tr>
                <tr>
                    <th>RX</th>
                    <th>SPH</th>
                    <th>CYL</th>
                    <th>AXIS</th>
                    <th>NVA</th>
                    <th>PH</th>
                    <th>CVA</th>
                </tr>
                <tr>
                    <th>OD</th>
                    <td style="text-align: center;">{{ $rf->OD_SPH }}</td>
                    <td style="text-align: center;">{{ $rf->OD_CYL }}</td>
                    <td style="text-align: center;">{{ $rf->OD_AXIS }}</td>
                    <td style="text-align: center;">{{ $rf->OD_NVA }}</td>
                    <td style="text-align: center;">{{ $rf->OD_PH }}</td>
                    <td style="text-align: center;">{{ $rf->OD_CVA }}</td>
                </tr>
                <tr>
                    <th>OS</th>
                    <td style="text-align: center;">{{ $rf->OS_SPH }}</td>
                    <td style="text-align: center;">{{ $rf->OS_CYL }}</td>
                    <td style="text-align: center;">{{ $rf->OS_AXIS }}</td>
                    <td style="text-align: center;">{{ $rf->OS_NVA }}</td>
                    <td style="text-align: center;">{{ $rf->OS_PH }}</td>
                    <td style="text-align: center;">{{ $rf->OS_CVA }}</td>
                </tr>
            </table>

            <table class="refraction">
                <tr>
                    <td colspan="2">
                        <b>ADD:</b>
                        {{ $rf->ADD }}
                    </td>
                    <td colspan="2">
                        <b>P.D.</b>
                        {{ $rf->PD }}
                    </td>
                    <td colspan="3">
                        <b>Tint:</b>
                        {{ $rf->tint }}
                    </td>
                </tr>
                <tr>
                    <td colspan="7">
                        <b>Frame:</b>
                        {{ $frames->implode(' / ') }}
                    </td>
                </tr>
                <tr>
                    <td colspan="7">
                        <b>Frame Size:</b>
                        {{ $frame_sizes->implode(' / ') }}
                    </td>
                </tr>
                <tr>
                    <td colspan="7">
                        <b>Lens:</b>
                        {{ $lenses->implode(' / ') }}
                    </td>
                </tr>
                <tr>
                    <td colspan="7">
                        <b>Lens Qty:</b>
                        {{ $lens_quantity->implode(' / ') }}
                    </td>
                </tr>
                <tr>
                    <td colspan="7">
                        <b>Remarks:</b>
                        {{ $rf->remarks }}
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <b>Deposit:</b>
                        {{ number_format($deposit, 2) }}
                    </td>
                    <td colspan="3">
                        <b>Amount:</b>
                        {{  number_format($total, 2) }}
                    </td>
                    <td colspan="2" style="background-color: rgb(255, 219, 219);">
                        <b>Balance:</b>
                        {{ $this->has_balance($balance) }}
                    </td>
                </tr>
            </table>

            <hr style="margin: 2rem 0;">

            <div class="border">
                <hgroup style="text-align:center; display:flex; align-items:center;">
                    <div class="border-r-gray" style="padding: 0 1rem;">
                        <small>
                            <i>CLAIM<br>STUB</i>
                        </small>
                    </div>
                    <div style="text-align:center; width:100%; padding:0.5rem;">
                        <h3 style="margin: 0 0.5rem;">DANGO OPTICAL CLINIC</h3>
                        <small>Monglow, Tandag City</small>
                        <br>
                        <div style="display:flex; gap:1rem; justify-content:center; margin-top:6px;">
                            <span>
                                <b>Smart#:</b> 09107163830
                            </span>
                            <span class="border-r-gray"></span>
                            <span>
                                <b>Globe#:</b> 09560244387
                            </span>
                        </div>
                    </div>
                </hgroup>
                <table class="claim-stub">
                    <tr class="border-b-gray border-t">
                        <td colspan="2" class="border-r-gray">
                            <b>Name:</b> {{ $rf->patient->name }} <br>
                        </td>
                        <td>
                            <b>Date:</b> {{ date('Y-M-d') }}
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <b>Address:</b> {{ $rf->patient->address }}
                        </td>
                    </tr>
                    <tr class="border-t">
                        <td class="border-r-gray">
                            <b>Deposit:</b> {{ number_format($deposit, 2) }}
                        </td>
                        <td class="border-r-gray">
                            <b>Amount:</b> {{  number_format($total, 2) }}
                        </td>
                        <td style="background-color: rgb(255, 219, 219);">
                            <b>Balance:</b> {{ $this->has_balance($balance) }}
                        </td>
                    </tr>

                    {{-- @if (!is_null($rf->purchase)) --}}
                        {{-- <tr class="border-t">
                            <td colspan="3" style="text-align:center; background-color:rgb(255, 255, 209); padding:0.7rem;">
                                <i><b>Important:</b> Please follow up after 7-10 days.</i>
                            </td>
                        </tr> --}}
                    {{-- @endif --}}
                </table>
                <div colspan="3" class="border-t" id="important" style="display:none; text-align:center; padding:0.4rem; background-color:rgb(255, 255, 209);">
                    <i><b>Important:</b> Please follow up after 7-10 days.</i>
                </div>
            </div>
        </div>
    </div>

    <div class="noPrint" style="display:flex; gap:2rem; align-items:center; margin-top:3rem;">
        <label for="myCheck">
            <input type="checkbox" name="" id="myCheck" onclick="myFunction()"> Print as Order
        </label>
        <button onclick="printDiv('printme')"  style="padding: 0.3rem 1rem;">
            <span style="display: flex; gap: 5px;">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-printer-fill" viewBox="0 0 16 16">
                    <path d="M5 1a2 2 0 0 0-2 2v1h10V3a2 2 0 0 0-2-2H5zm6 8H5a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1z"/>
                    <path d="M0 7a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2h-1v-2a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v2H2a2 2 0 0 1-2-2V7zm2.5 1a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z"/>
                </svg>
                Print
            </span>
        </button>
    </div>
</div>
