<tr>
    <td><input type="date"
            class="form-control date  modal-input m-auto @if (app()->isLocale('ar')) text-end @else  text-start @endif"
            name="attendances[{{ $row_index }}][date]" required></td>
    <td>
        {!! Form::select('attendances[' . $row_index . '][employee_id]', $employees, null, [
            'class' => 'form-control',
            'placeholder' => __('lang.please_select'),
            'required',
        ]) !!}
    </td>
    <td>
        <input type="time"
            class="form-control time  modal-input m-auto @if (app()->isLocale('ar')) text-end @else  text-start @endif"
            name="attendances[{{ $row_index }}][check_in]" required>
    </td>
    <td>
        <input type="time"
            class="form-control time  modal-input m-auto @if (app()->isLocale('ar')) text-end @else  text-start @endif"
            name="attendances[{{ $row_index }}][check_out]" required>
    </td>
    <td>
        {!! Form::select(
            'attendances[' . $row_index . '][status]',
            ['present' => 'Present', 'late' => 'Late', 'on_leave' => 'On Leave'],
            null,
            ['class' => 'form-control', 'placeholder' => __('lang.please_select'), 'required'],
        ) !!}
    </td>
    <td>
        {{ Auth::user()->name }}
    </td>
</tr>
