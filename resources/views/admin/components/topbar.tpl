

<div class="top-bar">
{if isset($user) && $user}
            <div>
                <h1 style="margin: 0; font-size: 24px; font-weight: 600; color: #1f2937;">Hello, {$user.user_name|escape}</h1>
            </div>
            <div class="user-profile">
                <span style="color: #6b7280; font-size: 14px;">{$user.created_at|escape}</span>
           <div class='text-center user-avatar border-none rounded rounded-circle  d-flex justify-content-center align-items-center'></div>                
           
                <img src="{$user.user_image|escape}" alt="" class="user-avatar">
         
                <div>
                    <div style="font-weight: 600; font-size: 14px;">{$user.user_name|escape}</div>
                    <div style="color: #6b7280; font-size: 12px;">@{$user.user_name|escape}</div>
                </div>
                <div class="dropdown">
                    <a href='tel:+2347033506332' class="btn" type="button" data-bs-toggle="dropdown">
                        <i class="fas fa-phone"></i>
                    </a>
                </div>
                <div class="dropdown">
                    <a class="btn" type="button" data-bs-toggle="dropdown">
                        <i class="fas fa-bell"></i> (<span class='text-danger'>0</span>)
                    </a>
                </div> 
                <div class="dropdown">
                    <button class="btn" type="button" data-bs-toggle="dropdown">
                        <i class="fas fa-ellipsis-h"></i>
                    </button>
                </div>
            </div>

{/if}
        </div>