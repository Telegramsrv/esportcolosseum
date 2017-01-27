@extends('layouts.user.gamer-layout')

@section('game-info')
    <section>
        <div class="game-banner z-depth-2">
            <div class="game-banner-title text-shadow">{!! $selectedGame->name !!} (Open Challenge)</div>
            <img src="{!! url(env('UPLOAD_GAME_BANNER', 'storage/games/large/').$selectedGame->banner_image) !!}" />
        </div>
    </section>
@endsection
@section('gamer-content')
	<section class="">
        <div class="section-title ">Challenges <span>List</span></div>
        <div class="challenge-page-tab-back">
                <div class="">
                    <ul class='tabs'>
                        <li><a class="active" href='#tab1'><i class="fa fa-user" aria-hidden="true"></i><span>Solo </span></a></li>
                        <li><a href='#tab2'><i class="fa fa-users" aria-hidden="true"></i><span>Team</span></a></li>
                    </ul>
                </div>
                
        </div>
            <div class="inner-page-tab-back"> 
            		<div class="row">           
                    <div id='tab1'>
                    		<div class="row buttons-block ">
                        		<div class="col s13">
                            	<button class="challengr-btn">25 Dec 2016</button>
                            </div>
                            <div class="col s13">
                            	<button class="challengr-btn">25 Dec 2016</button>
                            </div>
                            <div class="col s13">
                            	<button class="challengr-btn">25 Dec 2016</button>
                            </div>
                            <div class="col s13">
                            	<button class="challengr-btn">25 Dec 2016</button>
                            </div>
                            <div class="col s13">
                            	<button class="challengr-btn">25 Dec 2016</button>
                            </div>
                            <div class="col s13">
                            	<button class="challengr-btn">25 Dec 2016</button>
                            </div>
                            <div class="col s13">
                            	<button class="challengr-btn">25 Dec 2016</button>
                            </div>
                        </div>
                        <div class="col s12">
                        	<div class="time-block">
                            <ul class="timing disabled_for_mobile">
                              <li>00:00</li>
                              <li>03:00</li>
                              <li>06:00</li>
                              <li>09:00</li>
                              <li>12:00</li>
                              <li>05:00</li>
                              <li>08:00</li>
                              <li>21:00</li>
                            </ul>
                            <div class="timing display_for_mobile_drop">
                              <select id="leave"  style="display: block">
                                  <option value="tab1"><a href="#"> 00:00 </a></option>
                                  <option value="tab2"><a href="#"> 03:00</a></option>
                                  <option value="tab1"><a href="#"> 00:00 </a></option>
                                  <option value="tab2"><a href="#"> 03:00</a></option>
                                  <option value="tab1"><a href="#"> 00:00 </a></option>
                                  <option value="tab2"><a href="#"> 03:00</a></option>
                              </select>
                              <i class="fa fa-caret-down" aria-hidden="true"></i> 
                          </div>
                            
                            <div class="ist-time">
                              <i class="fa fa-angle-down" aria-hidden="true"></i><span>10:10:35 (IST)</span>
                            </div>
                          </div>
                        </div>
                        
                        <!-- ROW 1 -->
                        <div class="row">
                        	<div class="col s12 m3">
                          	<div class="challenge-member">
                            	<div class="ch-coin-block">
                                  <div class="ch-coin">
                                    win <span>16</span> coins
                                  </div>
                                  <div class="ch-coin-black">
                                    Pay <span>10</span> coins
                                  </div>
                              </div>
                              <div class="member-block">
                              		<div class="members">members<span>1 / 2</span></div>
                                  <button class="join-btn">Join</button>
                              </div>
                            </div>
                          </div>
                          <div class="col s12 m3">
                          	<div class="challenge-member">
                            	<div class="ch-coin-block">
                                  <div class="ch-coin">
                                    win <span>16</span> coins
                                  </div>
                                  <div class="ch-coin-black">
                                    Pay <span>10</span> coins
                                  </div>
                              </div>
                              <div class="member-block">
                              		<div class="members">members<span>1 / 2</span></div>
                                  <button class="join-btn">Join</button>
                              </div>
                            </div>
                          </div>
                          <div class="col s12 m3">
                          	<div class="challenge-member">
                            	<div class="ch-coin-block">
                                  <div class="ch-coin">
                                    win <span>16</span> coins
                                  </div>
                                  <div class="ch-coin-black">
                                    Pay <span>10</span> coins
                                  </div>
                              </div>
                              <div class="member-block">
                              		<div class="members">members<span>1 / 2</span></div>
                                  <button class="join-btn">Join</button>
                              </div>
                            </div>
                          </div>
                          <div class="col s12 m3">
                          	<div class="challenge-member">
                            	<div class="ch-coin-block">
                                  <div class="ch-coin">
                                    win <span>16</span> coins
                                  </div>
                                  <div class="ch-coin-black">
                                    Pay <span>10</span> coins
                                  </div>
                              </div>
                              <div class="member-block">
                              		<div class="members">members<span>1 / 2</span></div>
                                  <button class="join-btn">Join</button>
                              </div>
                            </div>
                          </div>
                        </div>
                        
                        <!-- ROW 2 -->
                        <div class="row">
                        	<div class="col s12 m3">
                          	<div class="challenge-member">
                            	<div class="ch-coin-block">
                                  <div class="ch-coin">
                                    win <span>16</span> coins
                                  </div>
                                  <div class="ch-coin-black">
                                    Pay <span>10</span> coins
                                  </div>
                              </div>
                              <div class="member-block">
                              		<div class="members">members<span>1 / 2</span></div>
                                  <button class="join-btn">Join</button>
                              </div>
                            </div>
                          </div>
                          <div class="col s12 m3">
                          	<div class="challenge-member">
                            	<div class="ch-coin-block">
                                  <div class="ch-coin">
                                    win <span>16</span> coins
                                  </div>
                                  <div class="ch-coin-black">
                                    Pay <span>10</span> coins
                                  </div>
                              </div>
                              <div class="member-block">
                              		<div class="members">members<span>1 / 2</span></div>
                                  <button class="join-btn">Join</button>
                              </div>
                            </div>
                          </div>
                          <div class="col s12 m3">
                          	<div class="challenge-member">
                            	<div class="ch-coin-block">
                                  <div class="ch-coin">
                                    win <span>16</span> coins
                                  </div>
                                  <div class="ch-coin-black">
                                    Pay <span>10</span> coins
                                  </div>
                              </div>
                              <div class="member-block">
                              		<div class="members">members<span>1 / 2</span></div>
                                  <button class="join-btn">Join</button>
                              </div>
                            </div>
                          </div>
                          <div class="col s12 m3">
                          	<div class="challenge-member">
                            	<div class="ch-coin-block">
                                  <div class="ch-coin">
                                    win <span>16</span> coins
                                  </div>
                                  <div class="ch-coin-black">
                                    Pay <span>10</span> coins
                                  </div>
                              </div>
                              <div class="member-block">
                              		<div class="members">members<span>1 / 2</span></div>
                                  <button class="join-btn">Join</button>
                              </div>
                            </div>
                          </div>
                        </div>
                        
                        <!-- ROW 3 -->
                        <div class="row">
                        	<div class="col s12 m3">
                          	<div class="challenge-member">
                            	<div class="ch-coin-block">
                                  <div class="ch-coin">
                                    win <span>16</span> coins
                                  </div>
                                  <div class="ch-coin-black">
                                    Pay <span>10</span> coins
                                  </div>
                              </div>
                              <div class="member-block">
                              		<div class="members">members<span>1 / 2</span></div>
                                  <button class="join-btn">Join</button>
                              </div>
                            </div>
                          </div>
                          <div class="col s12 m3">
                          	<div class="challenge-member">
                            	<div class="ch-coin-block">
                                  <div class="ch-coin">
                                    win <span>16</span> coins
                                  </div>
                                  <div class="ch-coin-black">
                                    Pay <span>10</span> coins
                                  </div>
                              </div>
                              <div class="member-block">
                              		<div class="members">members<span>1 / 2</span></div>
                                  <button class="join-btn">Join</button>
                              </div>
                            </div>
                          </div>
                          <div class="col s12 m3">
                          	<div class="challenge-member">
                            	<div class="ch-coin-block">
                                  <div class="ch-coin">
                                    win <span>16</span> coins
                                  </div>
                                  <div class="ch-coin-black">
                                    Pay <span>10</span> coins
                                  </div>
                              </div>
                              <div class="member-block">
                              		<div class="members">members<span>1 / 2</span></div>
                                  <button class="join-btn">Join</button>
                              </div>
                            </div>
                          </div>
                          <div class="col s12 m3">
                          	<div class="challenge-member">
                            	<div class="ch-coin-block">
                                  <div class="ch-coin">
                                    win <span>16</span> coins
                                  </div>
                                  <div class="ch-coin-black">
                                    Pay <span>10</span> coins
                                  </div>
                              </div>
                              <div class="member-block">
                              		<div class="members">members<span>1 / 2</span></div>
                                  <button class="join-btn">Join</button>
                              </div>
                            </div>
                          </div>
                        </div>
                        
                        <!-- ROW 4 -->
                         <div class="row">
                        	<div class="col s12 m3">
                          	<div class="challenge-member">
                            	<div class="ch-coin-block">
                                  <div class="ch-coin">
                                    win <span>16</span> coins
                                  </div>
                                  <div class="ch-coin-black">
                                    Pay <span>10</span> coins
                                  </div>
                              </div>
                              <div class="member-block">
                              		<div class="members">members<span>1 / 2</span></div>
                                  <button class="join-btn">Join</button>
                              </div>
                            </div>
                          </div>
                          <div class="col s12 m3">
                          	<div class="challenge-member">
                            	<div class="ch-coin-block">
                                  <div class="ch-coin">
                                    win <span>16</span> coins
                                  </div>
                                  <div class="ch-coin-black">
                                    Pay <span>10</span> coins
                                  </div>
                              </div>
                              <div class="member-block">
                              		<div class="members">members<span>1 / 2</span></div>
                                  <button class="join-btn">Join</button>
                              </div>
                            </div>
                          </div>
                          <div class="col s12 m3">
                          	<div class="challenge-member">
                            	<div class="ch-coin-block">
                                  <div class="ch-coin">
                                    win <span>16</span> coins
                                  </div>
                                  <div class="ch-coin-black">
                                    Pay <span>10</span> coins
                                  </div>
                              </div>
                              <div class="member-block">
                              		<div class="members">members<span>1 / 2</span></div>
                                  <button class="join-btn">Join</button>
                              </div>
                            </div>
                          </div>
                          
                        </div>
                    </div>
                    <div id='tab2'>
                    		<div class="row buttons-block ">
                        		<div class="col s13">
                            	<button class="challengr-btn">25 Dec 2016</button>
                            </div>
                            <div class="col s13">
                            	<button class="challengr-btn">25 Dec 2016</button>
                            </div>
                            <div class="col s13">
                            	<button class="challengr-btn">25 Dec 2016</button>
                            </div>
                            <div class="col s13">
                            	<button class="challengr-btn">25 Dec 2016</button>
                            </div>
                            <div class="col s13">
                            	<button class="challengr-btn">25 Dec 2016</button>
                            </div>
                            <div class="col s13">
                            	<button class="challengr-btn">25 Dec 2016</button>
                            </div>
                            <div class="col s13">
                            	<button class="challengr-btn">25 Dec 2016</button>
                            </div>
                        </div>
                        <div class="col s12">
                        	<div class="time-block">
                            <ul class="timing disabled_for_mobile">
                              <li>00:00</li>
                              <li>03:00</li>
                              <li>06:00</li>
                              <li>09:00</li>
                              <li>12:00</li>
                              <li>05:00</li>
                              <li>08:00</li>
                              <li>21:00</li>
                            </ul>
                            <div class="timing display_for_mobile_drop">
                              <select id="leave"  style="display: block">
                                  <option value="tab1"><a href="#"> 00:00 </a></option>
                                  <option value="tab2"><a href="#"> 03:00</a></option>
                                  <option value="tab1"><a href="#"> 00:00 </a></option>
                                  <option value="tab2"><a href="#"> 03:00</a></option>
                                  <option value="tab1"><a href="#"> 00:00 </a></option>
                                  <option value="tab2"><a href="#"> 03:00</a></option>
                              </select>
                              <i class="fa fa-caret-down" aria-hidden="true"></i> 
                          </div>
                            
                            <div class="ist-time">
                              <i class="fa fa-angle-down" aria-hidden="true"></i><span>10:10:35 (IST)</span>
                            </div>
                          </div>
                        </div>
                        
                        <!-- ROW 1 -->
                        <div class="row">
                        	<div class="col s12 m3">
                          	<div class="challenge-member">
                            	<div class="ch-coin-block">
                                  <div class="ch-coin">
                                    win <span>16</span> coins
                                  </div>
                                  <div class="ch-coin-black">
                                    Pay <span>10</span> coins
                                  </div>
                              </div>
                              <div class="member-block">
                              		<div class="members">members<span>1 / 2</span></div>
                                  <button class="join-btn">Join</button>
                              </div>
                            </div>
                          </div>
                          <div class="col s12 m3">
                          	<div class="challenge-member">
                            	<div class="ch-coin-block">
                                  <div class="ch-coin">
                                    win <span>16</span> coins
                                  </div>
                                  <div class="ch-coin-black">
                                    Pay <span>10</span> coins
                                  </div>
                              </div>
                              <div class="member-block">
                              		<div class="members">members<span>1 / 2</span></div>
                                  <button class="join-btn">Join</button>
                              </div>
                            </div>
                          </div>
                          <div class="col s12 m3">
                          	<div class="challenge-member">
                            	<div class="ch-coin-block">
                                  <div class="ch-coin">
                                    win <span>16</span> coins
                                  </div>
                                  <div class="ch-coin-black">
                                    Pay <span>10</span> coins
                                  </div>
                              </div>
                              <div class="member-block">
                              		<div class="members">members<span>1 / 2</span></div>
                                  <button class="join-btn">Join</button>
                              </div>
                            </div>
                          </div>
                          <div class="col s12 m3">
                          	<div class="challenge-member">
                            	<div class="ch-coin-block">
                                  <div class="ch-coin">
                                    win <span>16</span> coins
                                  </div>
                                  <div class="ch-coin-black">
                                    Pay <span>10</span> coins
                                  </div>
                              </div>
                              <div class="member-block">
                              		<div class="members">members<span>1 / 2</span></div>
                                  <button class="join-btn">Join</button>
                              </div>
                            </div>
                          </div>
                        </div>
                        
                        <!-- ROW 2 -->
                        <div class="row">
                        	<div class="col s12 m3">
                          	<div class="challenge-member">
                            	<div class="ch-coin-block">
                                  <div class="ch-coin">
                                    win <span>16</span> coins
                                  </div>
                                  <div class="ch-coin-black">
                                    Pay <span>10</span> coins
                                  </div>
                              </div>
                              <div class="member-block">
                              		<div class="members">members<span>1 / 2</span></div>
                                  <button class="join-btn">Join</button>
                              </div>
                            </div>
                          </div>
                          <div class="col s12 m3">
                          	<div class="challenge-member">
                            	<div class="ch-coin-block">
                                  <div class="ch-coin">
                                    win <span>16</span> coins
                                  </div>
                                  <div class="ch-coin-black">
                                    Pay <span>10</span> coins
                                  </div>
                              </div>
                              <div class="member-block">
                              		<div class="members">members<span>1 / 2</span></div>
                                  <button class="join-btn">Join</button>
                              </div>
                            </div>
                          </div>
                          <div class="col s12 m3">
                          	<div class="challenge-member">
                            	<div class="ch-coin-block">
                                  <div class="ch-coin">
                                    win <span>16</span> coins
                                  </div>
                                  <div class="ch-coin-black">
                                    Pay <span>10</span> coins
                                  </div>
                              </div>
                              <div class="member-block">
                              		<div class="members">members<span>1 / 2</span></div>
                                  <button class="join-btn">Join</button>
                              </div>
                            </div>
                          </div>
                          <div class="col s12 m3">
                          	<div class="challenge-member">
                            	<div class="ch-coin-block">
                                  <div class="ch-coin">
                                    win <span>16</span> coins
                                  </div>
                                  <div class="ch-coin-black">
                                    Pay <span>10</span> coins
                                  </div>
                              </div>
                              <div class="member-block">
                              		<div class="members">members<span>1 / 2</span></div>
                                  <button class="join-btn">Join</button>
                              </div>
                            </div>
                          </div>
                        </div>
                        
                        <!-- ROW 3 -->
                        <div class="row">
                        	<div class="col s12 m3">
                          	<div class="challenge-member">
                            	<div class="ch-coin-block">
                                  <div class="ch-coin">
                                    win <span>16</span> coins
                                  </div>
                                  <div class="ch-coin-black">
                                    Pay <span>10</span> coins
                                  </div>
                              </div>
                              <div class="member-block">
                              		<div class="members">members<span>1 / 2</span></div>
                                  <button class="join-btn">Join</button>
                              </div>
                            </div>
                          </div>
                          <div class="col s12 m3">
                          	<div class="challenge-member">
                            	<div class="ch-coin-block">
                                  <div class="ch-coin">
                                    win <span>16</span> coins
                                  </div>
                                  <div class="ch-coin-black">
                                    Pay <span>10</span> coins
                                  </div>
                              </div>
                              <div class="member-block">
                              		<div class="members">members<span>1 / 2</span></div>
                                  <button class="join-btn">Join</button>
                              </div>
                            </div>
                          </div>
                          <div class="col s12 m3">
                          	<div class="challenge-member">
                            	<div class="ch-coin-block">
                                  <div class="ch-coin">
                                    win <span>16</span> coins

                                  </div>
                                  <div class="ch-coin-black">
                                    Pay <span>10</span> coins
                                  </div>
                              </div>
                              <div class="member-block">
                              		<div class="members">members<span>1 / 2</span></div>
                                  <button class="join-btn">Join</button>
                              </div>
                            </div>
                          </div>
                          <div class="col s12 m3">
                          	<div class="challenge-member">
                            	<div class="ch-coin-block">
                                  <div class="ch-coin">
                                    win <span>16</span> coins
                                  </div>
                                  <div class="ch-coin-black">
                                    Pay <span>10</span> coins
                                  </div>
                              </div>
                              <div class="member-block">
                              		<div class="members">members<span>1 / 2</span></div>
                                  <button class="join-btn">Join</button>
                              </div>
                            </div>
                          </div>
                        </div>
                        
                        <!-- ROW 4 -->
                         <div class="row">
                        	<div class="col s12 m3">
                          	<div class="challenge-member">
                            	<div class="ch-coin-block">
                                  <div class="ch-coin">
                                    win <span>16</span> coins
                                  </div>
                                  <div class="ch-coin-black">
                                    Pay <span>10</span> coins
                                  </div>
                              </div>
                              <div class="member-block">
                              		<div class="members">members<span>1 / 2</span></div>
                                  <button class="join-btn">Join</button>
                              </div>
                            </div>
                          </div>
                          <div class="col s12 m3">
                          	<div class="challenge-member">
                            	<div class="ch-coin-block">
                                  <div class="ch-coin">
                                    win <span>16</span> coins
                                  </div>
                                  <div class="ch-coin-black">
                                    Pay <span>10</span> coins
                                  </div>
                              </div>
                              <div class="member-block">
                              		<div class="members">members<span>1 / 2</span></div>
                                  <button class="join-btn">Join</button>
                              </div>
                            </div>
                          </div>
                          <div class="col s12 m3">
                          	<div class="challenge-member">
                            	<div class="ch-coin-block">
                                  <div class="ch-coin">
                                    win <span>16</span> coins
                                  </div>
                                  <div class="ch-coin-black">
                                    Pay <span>10</span> coins
                                  </div>
                              </div>
                              <div class="member-block">
                              		<div class="members">members<span>1 / 2</span></div>
                                  <button class="join-btn">Join</button>
                              </div>
                            </div>
                          </div>
                          
                        </div>
                    </div>
                   
                </div>
            </div>
        </section>
@endsection