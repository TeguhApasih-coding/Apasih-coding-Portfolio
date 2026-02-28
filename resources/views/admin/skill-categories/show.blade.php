<x-admin-layout>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Category Information</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-borderless">
                            <tr>
                                <th width="120">Name:</th>
                                <td>{{ $skillCategory->name }}</td>
                            </tr>
                            <tr>
                                <th>Slug:</th>
                                <td><code>{{ $skillCategory->slug }}</code></td>
                            </tr>
                            <tr>
                                <th>Description:</th>
                                <td>{{ $skillCategory->description ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th>Display Order:</th>
                                <td>{{ $skillCategory->display_order }}</td>
                            </tr>
                            <tr>
                                <th>Status:</th>
                                <td>
                                    @if($skillCategory->is_active)
                                        <span class="badge bg-success">Active</span>
                                    @else
                                        <span class="badge bg-secondary">Inactive</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Total Skills:</th>
                                <td>
                                    <span class="badge bg-info">{{ $skillCategory->skills->count() }}</span>
                                    <span class="badge bg-success">{{ $skillCategory->active_skills_count }} Active</span>
                                </td>
                            </tr>
                            <tr>
                                <th>Created:</th>
                                <td>{{ $skillCategory->created_at->format('d M Y H:i') }}</td>
                            </tr>
                            <tr>
                                <th>Last Updated:</th>
                                <td>{{ $skillCategory->updated_at->format('d M Y H:i') }}</td>
                            </tr>
                        </table>

                        <div class="d-flex gap-2 mt-3">
                            <a href="{{ route('admin.skill-categories.edit', $skillCategory) }}" 
                            class="btn btn-warning flex-fill">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <form action="{{ route('admin.skill-categories.destroy', $skillCategory) }}" 
                                method="POST" 
                                class="flex-fill delete-form">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger w-100">
                                    <i class="fas fa-trash"></i> Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Skills in this Category</h5>
                        <a href="{{ route('admin.skills.create', ['category' => $skillCategory->id]) }}" 
                        class="btn btn-sm btn-primary">
                            <i class="fas fa-plus"></i> Add Skill
                        </a>
                    </div>
                    <div class="card-body">
                        @if($skillCategory->skills->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Order</th>
                                            <th>Name</th>
                                            <th>Icon</th>
                                            <th>Progress</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($skillCategory->skills as $skill)
                                        <tr>
                                            <td>{{ $skill->display_order }}</td>
                                            <td>{{ $skill->name }}</td>
                                            <td>
                                                @if($skill->icon)
                                                    <i class="{{ $skill->icon }}"></i>
                                                    <small class="text-muted">{{ $skill->icon }}</small>
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td>
                                                <div class="progress" style="height: 20px;">
                                                    <div class="progress-bar" 
                                                        role="progressbar" 
                                                        style="width: {{ $skill->progress }}%;"
                                                        aria-valuenow="{{ $skill->progress }}" 
                                                        aria-valuemin="0" 
                                                        aria-valuemax="100">
                                                        {{ $skill->progress }}%
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                @if($skill->is_active)
                                                    <span class="badge bg-success">Active</span>
                                                @else
                                                    <span class="badge bg-secondary">Inactive</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.skills.edit', $skill) }}" 
                                                class="btn btn-sm btn-warning">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="text-center py-4">
                                <i class="fas fa-cogs fa-3x text-muted mb-3"></i>
                                <p>No skills found in this category.</p>
                                <a href="{{ route('admin.skills.create', ['category' => $skillCategory->id]) }}" 
                                class="btn btn-primary">
                                    Add your first skill
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Delete confirmation
        document.querySelector('.delete-form')?.addEventListener('submit', function(e) {
            e.preventDefault();
            if (confirm('Are you sure you want to delete this category?')) {
                this.submit();
            }
        });
    </script>
</x-admin-layout>