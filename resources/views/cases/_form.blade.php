@csrf

<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <!-- Case Number -->
    <div>
        <label for="case_number" class="block text-sm font-medium text-gray-700">Case Number <span class="text-red-500">*</span></label>
        <input type="text"
               name="case_number"
               id="case_number"
               value="{{ old('case_number', $case->case_number ?? $caseNumber ?? '') }}"
               required
               placeholder="CASE-2026-0001"
               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('case_number') border-red-300 text-red-900 focus:border-red-500 focus:ring-red-500 @enderror">
        @error('case_number')
            <p class="mt-1 text-sm text-red-600" id="case_number_error">{{ $message }}</p>
        @enderror
    </div>

    <!-- Patient Reference -->
    <div>
        <label for="patient_reference" class="block text-sm font-medium text-gray-700">Patient Reference <span class="text-red-500">*</span></label>
        <input type="text"
               name="patient_reference"
               id="patient_reference"
               value="{{ old('patient_reference', $case->patient_reference ?? '') }}"
               required
               placeholder="e.g. PT-2049"
               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('patient_reference') border-red-300 text-red-900 focus:border-red-500 focus:ring-red-500 @enderror">
        @error('patient_reference')
            <p class="mt-1 text-sm text-red-600" id="patient_reference_error">{{ $message }}</p>
        @enderror
    </div>

    <!-- Surgeon Name -->
    <div>
        <label for="surgeon_name" class="block text-sm font-medium text-gray-700">Surgeon Name <span class="text-red-500">*</span></label>
        <input type="text"
               name="surgeon_name"
               id="surgeon_name"
               value="{{ old('surgeon_name', $case->surgeon_name ?? '') }}"
               required
               placeholder="e.g. Dr. Sarah Jenkins"
               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('surgeon_name') border-red-300 text-red-900 focus:border-red-500 focus:ring-red-500 @enderror">
        @error('surgeon_name')
            <p class="mt-1 text-sm text-red-600" id="surgeon_name_error">{{ $message }}</p>
        @enderror
    </div>

    <!-- Implant Type -->
    <div>
        <label for="implant_type" class="block text-sm font-medium text-gray-700">Implant Type <span class="text-red-500">*</span></label>
        <input type="text"
               name="implant_type"
               id="implant_type"
               value="{{ old('implant_type', $case->implant_type ?? '') }}"
               required
               placeholder="e.g. Custom Titanium Hip Stem"
               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('implant_type') border-red-300 text-red-900 focus:border-red-500 focus:ring-red-500 @enderror">
        @error('implant_type')
            <p class="mt-1 text-sm text-red-600" id="implant_type_error">{{ $message }}</p>
        @enderror
    </div>

    <!-- Status -->
    <div>
        <label for="status" class="block text-sm font-medium text-gray-700">Status <span class="text-red-500">*</span></label>
        <select name="status"
                id="status"
                required
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('status') border-red-300 text-red-900 focus:border-red-500 focus:ring-red-500 @enderror">
            @foreach($statuses as $statusOption)
                <option value="{{ $statusOption }}" {{ old('status', $case->status ?? 'Draft') === $statusOption ? 'selected' : '' }}>
                    {{ $statusOption }}
                </option>
            @endforeach
        </select>
        @error('status')
            <p class="mt-1 text-sm text-red-600" id="status_error">{{ $message }}</p>
        @enderror
    </div>

    <!-- Priority -->
    <div>
        <label for="priority" class="block text-sm font-medium text-gray-700">Priority <span class="text-red-500">*</span></label>
        <select name="priority"
                id="priority"
                required
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('priority') border-red-300 text-red-900 focus:border-red-500 focus:ring-red-500 @enderror">
            @foreach($priorities as $priorityOption)
                <option value="{{ $priorityOption }}" {{ old('priority', $case->priority ?? 'Medium') === $priorityOption ? 'selected' : '' }}>
                    {{ $priorityOption }}
                </option>
            @endforeach
        </select>
        @error('priority')
            <p class="mt-1 text-sm text-red-600" id="priority_error">{{ $message }}</p>
        @enderror
    </div>

    <!-- Surgery Date -->
    <div class="md:col-span-2">
        <label for="surgery_date" class="block text-sm font-medium text-gray-700">Surgery Date (Optional)</label>
        <input type="date"
               name="surgery_date"
               id="surgery_date"
               value="{{ old('surgery_date', isset($case->surgery_date) && $case->surgery_date ? $case->surgery_date->format('Y-m-d') : '') }}"
               class="mt-1 block w-full md:w-1/2 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('surgery_date') border-red-300 text-red-900 focus:border-red-500 focus:ring-red-500 @enderror">
        @error('surgery_date')
            <p class="mt-1 text-sm text-red-600" id="surgery_date_error">{{ $message }}</p>
        @enderror
    </div>
</div>
