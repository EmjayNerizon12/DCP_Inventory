  <div id="print-header" style="display:none;" class="w-full flex flex-col justify-center items-center mb-4">

      <img class="h-24 w-24 object-cover rounded-full border-2 border-gray-300"
          src="{{ Auth::guard('school')->user()->school->image_path ? asset('school-logo/' . Auth::guard('school')->user()->school->image_path) : asset('icon/logo.png') }}"
          alt="">
      <div class="text-4xl font-bold text-gray-700">{{ Auth::guard('school')->user()->school->SchoolName }}
      </div>
      <div class="text-md text-gray-500">School Report - Generated on: <span id="current-time-date"></span>
      </div>
  </div>
