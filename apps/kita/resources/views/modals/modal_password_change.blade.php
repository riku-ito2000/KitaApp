<div class="modal fade" id="passwordChangeModal" tabindex="-1" aria-labelledby="passwordChangeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header" style="padding: 0 16px;">
                <h5 class="modal-title" id="passwordChangeModalLabel" style="margin: 0; padding: 10px 0;">
                    パスワード変更
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="閉じる"></button>
            </div>
            <div class="modal-body" style="background-color: white;">
                <form method="POST" action="{{ route('password.change') }}">
                    @csrf
                    @method('PUT')

                    <div class="form-group mb-3">
                        <label for="new_password">新しいパスワード</label>
                        <input type="password" class="form-control @error('new_password') is-invalid @enderror" id="new_password" name="new_password" required style="background-color: white;">
                        @error('new_password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="new_password_confirmation">新しいパスワード（確認）</label>
                        <input type="password" class="form-control" id="new_password_confirmation" name="new_password_confirmation" required style="background-color: white;">
                    </div>

                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn" style="background-color: #8BC34A; color: white; border: none; border-radius: 25px;">更新する</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
