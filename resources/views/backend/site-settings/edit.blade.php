@extends('backend.app')

@section('title', 'Site & homepage — ' . config('app.name'))

@section('content')
@include('backend.partials.cms-shell-start')
@php
    $s = fn ($key) => old($key, optional($rows->get($key))->value ?? '');
    $heroSlides = old('hero_slides', $formDefaults['hero_slides']);
    $socialRows = old('social_rows', $formDefaults['social_rows']);
    $statsRows = old('stats', $formDefaults['stats']);
    $bdRows = old('bangladesh_divisions', $formDefaults['bangladesh_divisions']);
    $videoRows = old('home_videos', $formDefaults['home_videos']);
    $activityRows = old('home_activities', $formDefaults['home_activities']);
@endphp

<div class="row">
    <div class="col-12 col-xl-11">
        @include('backend.partials.cms-header', [
            'title' => 'Site & homepage content',
            'subtitle' => 'Public navbar, hero, and home sections — saved as structured fields; the API still serves the same JSON keys for the React site (/api/v1/bootstrap).',
            'actionRoute' => route('admin.menu-items.index', ['zone' => 'about'], false),
            'actionLabel' => 'Edit menus',
        ])

        <form action="{{ route('admin.site-settings.update') }}" method="POST" class="mb-5">
            @csrf
            @method('PUT')

            <div class="accordion shadow-sm border-0 rounded-3 overflow-hidden cms-card" id="siteSettingsAccordion">
                <div class="accordion-item border-0">
                    <h2 class="accordion-header">
                        <button class="accordion-button fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#accHeader">Header &amp; navigation labels</button>
                    </h2>
                    <div id="accHeader" class="accordion-collapse collapse show" data-bs-parent="#siteSettingsAccordion">
                        <div class="accordion-body row g-3">
                            <div class="col-md-6"><label class="form-label small">Email</label><input type="email" name="header_email" class="form-control form-control-sm" value="{{ $s('header_email') }}"></div>
                            <div class="col-md-6"><label class="form-label small">Phone</label><input type="text" name="header_phone" class="form-control form-control-sm" value="{{ $s('header_phone') }}"></div>
                            <div class="col-12"><label class="form-label small">Volunteer CTA (top bar)</label><textarea name="header_volunteer_cta" class="form-control form-control-sm" rows="2">{{ $s('header_volunteer_cta') }}</textarea></div>
                            <div class="col-md-6"><label class="form-label small">Logo alt text</label><input type="text" name="header_logo_alt" class="form-control form-control-sm" value="{{ $s('header_logo_alt') }}"></div>
                            <div class="col-md-6"><label class="form-label small">Donate button</label><input type="text" name="donate_button_label" class="form-control form-control-sm" value="{{ $s('donate_button_label') }}"></div>
                            <div class="col-6 col-lg-4"><label class="form-label small">Nav: Home</label><input type="text" name="nav_home_label" class="form-control form-control-sm" value="{{ $s('nav_home_label') }}"></div>
                            <div class="col-6 col-lg-4"><label class="form-label small">Nav: Bangladesh</label><input type="text" name="nav_bangladesh_label" class="form-control form-control-sm" value="{{ $s('nav_bangladesh_label') }}"></div>
                            <div class="col-6 col-lg-4"><label class="form-label small">Nav: Topics</label><input type="text" name="nav_topics_label" class="form-control form-control-sm" value="{{ $s('nav_topics_label') }}"></div>
                            <div class="col-6 col-lg-4"><label class="form-label small">Nav: About</label><input type="text" name="nav_about_label" class="form-control form-control-sm" value="{{ $s('nav_about_label') }}"></div>
                            <div class="col-6 col-lg-4"><label class="form-label small">Nav: Join Us</label><input type="text" name="nav_join_label" class="form-control form-control-sm" value="{{ $s('nav_join_label') }}"></div>
                            <div class="col-6 col-lg-4"><label class="form-label small">Nav: Gallery</label><input type="text" name="nav_gallery_label" class="form-control form-control-sm" value="{{ $s('nav_gallery_label') }}"></div>
                            <div class="col-6 col-lg-4"><label class="form-label small">Nav: Contact</label><input type="text" name="nav_contact_label" class="form-control form-control-sm" value="{{ $s('nav_contact_label') }}"></div>

                            <div class="col-12">
                                <label class="form-label fw-bold small">Social links</label>
                                <p class="text-muted small mb-2">Use network names <code>facebook</code>, <code>twitter</code>, <code>linkedin</code> (navbar maps these). Leave a row blank to skip.</p>
                                <div class="table-responsive border rounded-2">
                                    <table class="table table-sm align-middle mb-0">
                                        <thead class="table-light"><tr><th>Network</th><th>URL</th></tr></thead>
                                        <tbody>
                                            @foreach($socialRows as $i => $sr)
                                            <tr>
                                                <td style="width: 160px;">
                                                    <input type="text" name="social_rows[{{ $i }}][network]" class="form-control form-control-sm" value="{{ $sr['network'] ?? '' }}" placeholder="facebook">
                                                </td>
                                                <td>
                                                    <input type="text" name="social_rows[{{ $i }}][url]" class="form-control form-control-sm" value="{{ $sr['url'] ?? '' }}" placeholder="https://…">
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="accordion-item border-0 border-top">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#accHero">Hero slider &amp; CTAs</button>
                    </h2>
                    <div id="accHero" class="accordion-collapse collapse" data-bs-parent="#siteSettingsAccordion">
                        <div class="accordion-body row g-3">
                            <div class="col-12">
                                <label class="form-label fw-bold small">Slides</label>
                                <p class="text-muted small mb-2">Image URL (full URL or path). Rows with empty image are ignored.</p>
                                <div class="table-responsive border rounded-2">
                                    <table class="table table-sm align-middle mb-0">
                                        <thead class="table-light"><tr><th>#</th><th>Image URL</th><th>Alt text</th></tr></thead>
                                        <tbody>
                                            @foreach($heroSlides as $i => $slide)
                                            <tr>
                                                <td class="text-muted small">{{ $i + 1 }}</td>
                                                <td><input type="text" name="hero_slides[{{ $i }}][image]" class="form-control form-control-sm" value="{{ $slide['image'] ?? '' }}" placeholder="https://…"></td>
                                                <td><input type="text" name="hero_slides[{{ $i }}][alt]" class="form-control form-control-sm" value="{{ $slide['alt'] ?? '' }}" placeholder="Description"></td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-md-6"><label class="form-label small">Kicker</label><input type="text" name="hero_kicker" class="form-control form-control-sm" value="{{ $s('hero_kicker') }}"></div>
                            <div class="col-md-6"><label class="form-label small">Line 1</label><input type="text" name="hero_line1" class="form-control form-control-sm" value="{{ $s('hero_line1') }}"></div>
                            <div class="col-md-6"><label class="form-label small">Highlight</label><input type="text" name="hero_highlight" class="form-control form-control-sm" value="{{ $s('hero_highlight') }}"></div>
                            <div class="col-md-6"><label class="form-label small">Line 2</label><input type="text" name="hero_line2" class="form-control form-control-sm" value="{{ $s('hero_line2') }}"></div>
                            <div class="col-md-6"><label class="form-label small">Primary button</label><input type="text" name="hero_primary_label" class="form-control form-control-sm" value="{{ $s('hero_primary_label') }}"></div>
                            <div class="col-md-6"><label class="form-label small">Primary link</label><input type="text" name="hero_primary_href" class="form-control form-control-sm" value="{{ $s('hero_primary_href') }}"></div>
                            <div class="col-md-6"><label class="form-label small">Secondary button</label><input type="text" name="hero_secondary_label" class="form-control form-control-sm" value="{{ $s('hero_secondary_label') }}"></div>
                            <div class="col-md-6"><label class="form-label small">Secondary link</label><input type="text" name="hero_secondary_href" class="form-control form-control-sm" value="{{ $s('hero_secondary_href') }}"></div>
                        </div>
                    </div>
                </div>

                <div class="accordion-item border-0 border-top">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#accAbout">About strip &amp; lifestyle</button>
                    </h2>
                    <div id="accAbout" class="accordion-collapse collapse" data-bs-parent="#siteSettingsAccordion">
                        <div class="accordion-body row g-3">
                            <div class="col-12"><label class="form-label small">About title</label><input type="text" name="home_about_title" class="form-control form-control-sm" value="{{ $s('home_about_title') }}"></div>
                            <div class="col-12"><label class="form-label small">About body</label><textarea name="home_about_body" class="form-control form-control-sm" rows="5">{{ $s('home_about_body') }}</textarea></div>

                            <div class="col-12">
                                <label class="form-label fw-bold small">About stats (3 columns)</label>
                                <p class="text-muted small mb-2">Icon presets match the public site: <code>team</code>, <code>donate</code>, <code>fund</code>.</p>
                                <div class="table-responsive border rounded-2">
                                    <table class="table table-sm align-middle mb-0">
                                        <thead class="table-light"><tr><th>Caption</th><th>Value</th><th>Icon</th></tr></thead>
                                        <tbody>
                                            @foreach($statsRows as $i => $st)
                                            <tr>
                                                <td><input type="text" name="stats[{{ $i }}][caption]" class="form-control form-control-sm" value="{{ $st['caption'] ?? '' }}" placeholder="join our team"></td>
                                                <td style="width: 140px;"><input type="text" name="stats[{{ $i }}][value]" class="form-control form-control-sm" value="{{ $st['value'] ?? '' }}" placeholder="6,472+"></td>
                                                <td style="width: 140px;">
                                                    <select name="stats[{{ $i }}][icon]" class="form-select form-select-sm">
                                                        @foreach(['team' => 'Team', 'donate' => 'Donate', 'fund' => 'Fund'] as $iv => $il)
                                                        <option value="{{ $iv }}" @selected(($st['icon'] ?? 'team') === $iv)>{{ $il }}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="col-md-6"><label class="form-label small">More button label</label><input type="text" name="home_about_more_label" class="form-control form-control-sm" value="{{ $s('home_about_more_label') }}"></div>
                            <div class="col-md-6"><label class="form-label small">More link</label><input type="text" name="home_about_more_href" class="form-control form-control-sm" value="{{ $s('home_about_more_href') }}"></div>
                            <div class="col-md-4"><label class="form-label small">Lifestyle kicker</label><input type="text" name="lifestyle_kicker" class="form-control form-control-sm" value="{{ $s('lifestyle_kicker') }}"></div>
                            <div class="col-md-8"><label class="form-label small">Lifestyle title</label><input type="text" name="lifestyle_title" class="form-control form-control-sm" value="{{ $s('lifestyle_title') }}"></div>
                            <div class="col-12"><label class="form-label small">Lifestyle body</label><textarea name="lifestyle_body" class="form-control form-control-sm" rows="4">{{ $s('lifestyle_body') }}</textarea></div>
                        </div>
                    </div>
                </div>

                <div class="accordion-item border-0 border-top">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#accBangladesh">Bangladesh divisions &amp; districts</button>
                    </h2>
                    <div id="accBangladesh" class="accordion-collapse collapse" data-bs-parent="#siteSettingsAccordion">
                        <div class="accordion-body">
                            <p class="text-muted small">Division name + districts: <strong>one district per line</strong>. Empty division rows are skipped.</p>
                            <div class="table-responsive border rounded-2">
                                <table class="table table-sm align-middle mb-0">
                                    <thead class="table-light"><tr><th style="width: 180px;">Division</th><th>Districts (one per line)</th></tr></thead>
                                    <tbody>
                                        @foreach($bdRows as $i => $bd)
                                        <tr class="align-top">
                                            <td>
                                                <input type="text" name="bangladesh_divisions[{{ $i }}][division]" class="form-control form-control-sm" value="{{ $bd['division'] ?? '' }}" placeholder="Dhaka">
                                            </td>
                                            <td>
                                                <textarea name="bangladesh_divisions[{{ $i }}][districts]" class="form-control form-control-sm font-monospace" rows="3" placeholder="Dhaka&#10;Gazipur">{{ $bd['districts'] ?? '' }}</textarea>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="accordion-item border-0 border-top">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#accVideos">Videos, articles strip, donate block</button>
                    </h2>
                    <div id="accVideos" class="accordion-collapse collapse" data-bs-parent="#siteSettingsAccordion">
                        <div class="accordion-body row g-3">
                            <div class="col-md-4"><label class="form-label small">Videos section title</label><input type="text" name="videos_title" class="form-control form-control-sm" value="{{ $s('videos_title') }}"></div>
                            <div class="col-md-4"><label class="form-label small">“Watch more” label</label><input type="text" name="videos_more_label" class="form-control form-control-sm" value="{{ $s('videos_more_label') }}"></div>
                            <div class="col-md-4"><label class="form-label small">“Watch more” link</label><input type="text" name="videos_more_href" class="form-control form-control-sm" value="{{ $s('videos_more_href') }}"></div>

                            <div class="col-12">
                                <label class="form-label fw-bold small">Homepage videos</label>
                                <p class="text-muted small mb-2">YouTube/Vimeo embed URL (e.g. <code>https://www.youtube.com/embed/…</code>). Title and embed URL required; duration optional.</p>
                                <div class="table-responsive border rounded-2">
                                    <table class="table table-sm align-middle mb-0">
                                        <thead class="table-light"><tr><th>#</th><th>Title</th><th>Duration</th><th>Embed URL</th></tr></thead>
                                        <tbody>
                                            @foreach($videoRows as $i => $v)
                                            <tr>
                                                <td class="text-muted small">{{ $i + 1 }}</td>
                                                <td><input type="text" name="home_videos[{{ $i }}][title]" class="form-control form-control-sm" value="{{ $v['title'] ?? '' }}"></td>
                                                <td style="width: 100px;"><input type="text" name="home_videos[{{ $i }}][duration]" class="form-control form-control-sm" value="{{ $v['duration'] ?? '' }}" placeholder="04:29"></td>
                                                <td><input type="text" name="home_videos[{{ $i }}][videoUrl]" class="form-control form-control-sm font-monospace" value="{{ $v['videoUrl'] ?? '' }}"></td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="col-md-4"><label class="form-label small">Articles kicker</label><input type="text" name="latest_article_kicker" class="form-control form-control-sm" value="{{ $s('latest_article_kicker') }}"></div>
                            <div class="col-md-4"><label class="form-label small">Articles title</label><input type="text" name="latest_article_title" class="form-control form-control-sm" value="{{ $s('latest_article_title') }}"></div>
                            <div class="col-md-4"><label class="form-label small">Articles subtitle</label><input type="text" name="latest_article_subtitle" class="form-control form-control-sm" value="{{ $s('latest_article_subtitle') }}"></div>
                            <div class="col-12"><label class="form-label small">Support / donate title</label><input type="text" name="support_title" class="form-control form-control-sm" value="{{ $s('support_title') }}"></div>
                            <div class="col-12"><label class="form-label small">Support body</label><textarea name="support_body" class="form-control form-control-sm" rows="4">{{ $s('support_body') }}</textarea></div>
                        </div>
                    </div>
                </div>

                <div class="accordion-item border-0 border-top">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#accActivities">Activities carousel &amp; membership</button>
                    </h2>
                    <div id="accActivities" class="accordion-collapse collapse" data-bs-parent="#siteSettingsAccordion">
                        <div class="accordion-body row g-3">
                            <div class="col-12"><label class="form-label small">Activities title (use two lines: first line / second line)</label><textarea name="activities_title" class="form-control form-control-sm" rows="2">{{ $s('activities_title') }}</textarea></div>
                            <div class="col-md-6"><label class="form-label small">View more label</label><input type="text" name="activities_view_more_label" class="form-control form-control-sm" value="{{ $s('activities_view_more_label') }}"></div>
                            <div class="col-md-6"><label class="form-label small">View more link</label><input type="text" name="activities_view_more_href" class="form-control form-control-sm" value="{{ $s('activities_view_more_href') }}"></div>

                            <div class="col-12">
                                <label class="form-label fw-bold small">Activity cards</label>
                                <p class="text-muted small mb-2">Image URL required. For type <strong>Video</strong>, also set an embed URL.</p>
                                <div class="table-responsive border rounded-2">
                                    <table class="table table-sm align-middle mb-0">
                                        <thead class="table-light"><tr><th>#</th><th>Title</th><th>Type</th><th>Image URL</th><th>Video embed (if video)</th></tr></thead>
                                        <tbody>
                                            @foreach($activityRows as $i => $a)
                                            <tr>
                                                <td class="text-muted small">{{ $i + 1 }}</td>
                                                <td><input type="text" name="home_activities[{{ $i }}][title]" class="form-control form-control-sm" value="{{ $a['title'] ?? '' }}"></td>
                                                <td style="width: 110px;">
                                                    <select name="home_activities[{{ $i }}][type]" class="form-select form-select-sm">
                                                        <option value="image" @selected(($a['type'] ?? 'image') === 'image')>Image</option>
                                                        <option value="video" @selected(($a['type'] ?? '') === 'video')>Video</option>
                                                    </select>
                                                </td>
                                                <td><input type="text" name="home_activities[{{ $i }}][image]" class="form-control form-control-sm font-monospace" value="{{ $a['image'] ?? '' }}"></td>
                                                <td><input type="text" name="home_activities[{{ $i }}][videoUrl]" class="form-control form-control-sm font-monospace" value="{{ $a['videoUrl'] ?? '' }}"></td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="col-md-6"><label class="form-label small">Lifetime badge</label><input type="text" name="lifetime_badge" class="form-control form-control-sm" value="{{ $s('lifetime_badge') }}"></div>
                            <div class="col-md-6"><label class="form-label small">Lifetime title</label><input type="text" name="lifetime_title" class="form-control form-control-sm" value="{{ $s('lifetime_title') }}"></div>
                            <div class="col-12"><label class="form-label small">Lifetime body</label><textarea name="lifetime_body" class="form-control form-control-sm" rows="3">{{ $s('lifetime_body') }}</textarea></div>
                            <div class="col-md-6"><label class="form-label small">Lifetime CTA</label><input type="text" name="lifetime_cta" class="form-control form-control-sm" value="{{ $s('lifetime_cta') }}"></div>
                            <div class="col-md-6"><label class="form-label small">Lifetime footer note</label><input type="text" name="lifetime_footer_note" class="form-control form-control-sm" value="{{ $s('lifetime_footer_note') }}"></div>
                        </div>
                    </div>
                </div>

                <div class="accordion-item border-0 border-top">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#accJoin">Join movement block</button>
                    </h2>
                    <div id="accJoin" class="accordion-collapse collapse" data-bs-parent="#siteSettingsAccordion">
                        <div class="accordion-body row g-3">
                            <div class="col-md-6"><label class="form-label small">Title</label><input type="text" name="join_movement_title" class="form-control form-control-sm" value="{{ $s('join_movement_title') }}"></div>
                            <div class="col-md-6"><label class="form-label small">Button label</label><input type="text" name="join_movement_cta_label" class="form-control form-control-sm" value="{{ $s('join_movement_cta_label') }}"></div>
                            <div class="col-12"><label class="form-label small">Quote</label><textarea name="join_movement_quote" class="form-control form-control-sm" rows="4">{{ $s('join_movement_quote') }}</textarea></div>
                            <div class="col-md-4"><label class="form-label small">Author name</label><input type="text" name="join_movement_author" class="form-control form-control-sm" value="{{ $s('join_movement_author') }}"></div>
                            <div class="col-md-4"><label class="form-label small">Role</label><input type="text" name="join_movement_role" class="form-control form-control-sm" value="{{ $s('join_movement_role') }}"></div>
                            <div class="col-md-4"><label class="form-label small">Author image URL</label><input type="text" name="join_movement_image" class="form-control form-control-sm" value="{{ $s('join_movement_image') }}"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-4 d-flex gap-2">
                <button type="submit" class="btn btn-primary rounded-pill px-4"><i class="bi bi-check2-circle me-1"></i> Save all</button>
                <a href="{{ route('dashboard', [], false) }}" class="btn btn-outline-secondary rounded-pill">Cancel</a>
            </div>
        </form>
    </div>
</div>
@include('backend.partials.cms-shell-end')
@endsection
