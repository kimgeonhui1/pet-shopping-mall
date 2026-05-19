# pet-shopping-mall
# DB 연동 기반 펫 용품 풀스택 쇼핑몰 웹 서비스

### 🛠️ Tech Stack
- Backend/Frontend: PHP, JavaScript, HTML5, CSS3
- Database: MySQL
- Web Server: Apache

1. 비정상 접근 및 권한 우회 제어 검증 (`dbconn.php`, `noticedel.php`)

   - `member` 테이블 내 `role(admin/user)` 컬럼 설계를 바탕으로 권한 검증 로직(`isAdmin()`)을 구현했습니다. 일반 유저가 URL 우회나 직접적인 스크립트 접근을 통해 관리자 공지사항을 삭제(`noticedel.php`)하거나 수정하는 예외 케이스를 선제 차단하고 검증했습니다.

2. 백엔드단 데이터 무결성(Data Integrity) 테스트 (`check_email.php`, `check_name.php`)

   - 회원가입 및 정보 수정 프로세스에서 이메일과 닉네임의 중복 여부를 프론트엔드뿐만 아니라 백엔드단에서 SQL 쿼리 조회를 통해 논리적으로 한 번 더 검증하여 데이터베이스 내 중복 데이터 적재 오류를 원천 차단했습니다.

4. 결제 및 비즈니스 로직 예외 처리 (`addcartproc.php`)

   - 장바구니 담기 및 결제 프로세스에서 수량(`qty`) 데이터와 가격(`price`) 데이터를 연동하여 `total_price`가 논리적 오류 없이 정확히 산출되고 데이터베이스(`cart` 테이블)에 삽입되는 비즈니스 데이터 흐름의 무결성을 검증 완료했습니다.
