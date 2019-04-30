<section class="pb-0">
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-7 mx-auto">
                <!-- title -->
                <div class="title text-center">
                    <span class="pre-title">{{ __('Check out our') }}</span>
                    <h2>{{ __('Our Courses') }}</h2>
                    <p class="mb-0">{{ __('Prepared by the best in their field') }}!</p>
                </div>
            </div>
            <div class="card-columns">
                @forelse($courses as $course)
                    <div class="card">
                        <img src="{{ $course->pathAttachment() }}" class="card-img-top" alt="{{ $course->name }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $course->name }}</h5>
                            <p class="card-text">{{ str_limit($course->description, 100) }}</p>
                            <p class="card-text">
                                <small class="text-muted">{{ $course->created_at->format('d/m/Y') }}</small>
                            </p>
                        </div>
                    </div>
                @empty
                <div class="alert alert-dark">
                    {{ __("There is no course available") }}
                </div>
                @endforelse
                <div class="row justify-content-center">
                    {{ $courses->links() }}
                </div>
            </div>
        </div>
    </div>
</section>